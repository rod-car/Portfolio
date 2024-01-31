<?php

namespace RodCar\Portfolio;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class ValidationMiddleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
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
            $response->getBody()->write(json_encode(['success' => false, 'errors' => $errors]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        return $next($request, $response);
    }
}
