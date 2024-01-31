<?php

use Slim\Views\Twig;
use RodCar\Portfolio\Flash;
use Slim\Factory\AppFactory;
use PHPMailer\PHPMailer\SMTP;
use RodCar\Portfolio\Projects;
use Slim\Views\TwigMiddleware;
use PHPMailer\PHPMailer\PHPMailer;
use Respect\Validation\Validator as v;
use Slim\Exception\HttpNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Exception\HttpException;

// ini_set('display_errors', false);

require __DIR__ . '/../vendor/autoload.php';

session_start();

$app = AppFactory::create();

$twig = Twig::create(dirname(__DIR__) . '/resources/views', ['cache' => false]);

$app->add(TwigMiddleware::create($app, $twig));

$app->get('/', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    $projects = Projects::all();

    return $view->render($response, 'home.html', [
        'projects' => $projects
    ]);
})->setName('home');

$app->get('/biography', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);

    return $view->render($response, 'biography.html', ['active' => 'biography']);
})->setName('biography');

$app->get('/contact', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    $success = Flash::get('success');
    $error = Flash::get('error');
    $errors = Flash::validation(action: 'get');

    return $view->render($response, 'contact.html', [
        'error' => $error,
        'success' => $success,
        'errors' => $errors,
        'active' => 'contact'
    ]);
})->setName('contact');

$app->post('/contact', function (Request $request, Response $response) use ($twig) {
    $data = $request->getParsedBody();

    $rules = [
        'name' => v::notEmpty()->alpha()->length(2, 255),
        'email' => v::notEmpty()->email(),
        'message' => v::notEmpty()->length(5, 1000)
    ];

    foreach ($rules as $field => $rule) {
        try {
            $rule->setName($field)->assert($data[$field]);
        } catch (NestedValidationException $e) {
            $errors[$field] = $e->getMessages();
        }
    }

    if (!empty($errors)) {
        Flash::validation($errors);
        return $response
            ->withHeader('Location', '/contact')
            ->withStatus(301);
    }

    $mail = new PHPMailer(true);

    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ghislaincarino@gmail.com';                     //SMTP username
    $mail->Password   = 'dhvd whtu zamj isdn';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($data['email'], $data['name']);
    $mail->addAddress('ghislaincarino@gmail.com', 'Gislain Carino Rodrigue BOUDI');
    $mail->addReplyTo($data['email'], 'Reply');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Contact from portfolio';
    $mail->Body    = $twig->fetch('email-template.twig', [
        'subject' => 'Contact from portfolio',
        'name' => $data['name'],
        'message' => $data['message'],
        'email' => $data['email']
    ]);

    if (!$mail->send()) {
        Flash::set('error', 'Cannot send email');
        return $response
            ->withHeader('Location', '/contact')
            ->withStatus(422);
    }

    Flash::set('success', 'Mail sent successfully');
    return $response
        ->withHeader('Location', '/contact')
        ->withStatus(301);
});

$app->get('/details/{id}', function (Request $request, Response $response, array $args) use ($app) {
    $view = Twig::fromRequest($request);
    $project = Projects::find($args['id']);
    
    if ($project === null) return $response
        ->withHeader('Location', '/error')
        ->withStatus(301);

    return $view->render($response, 'details.html', [
        'project' => $project,
        'active' => 'contact'
    ]);
})->setName('details');

$app->get('/{any}', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    $response->withStatus(404);

    return $view->render($response, 'errors/404.html', [
        'active' => 'error'
    ]);
})->setName('errors');

$app->run();