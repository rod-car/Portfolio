<?php

namespace RodCar\Portfolio;

class Projects
{
    private static array $PROJECTS = [
        [
            'id' => 1,
            'title' => 'Clinique Hugney',
            'technology' => [
                'simple' => 'Laravel 8, Laravel Livewire',
                'detailed' => 'Laravel pour la partie Back-end, Bootstrap 5 pour la partie Front-end, et Laravel Livewire pour le dynamisme'
            ],
            'image' => 'hugney.PNG',
            'description' => 'Application web utilisant le rendu cote serveur, pour gerer les activites de CLINIQUE HUGNEY (gestion des patients, gestion des stocks des medicaments , gestion des personnelles, etc.). Permet de visualiser le statistique de tous les services, la statistique des patients. Je suis charge de toute la partie Back-end.',
            
            'full-description' => 'Cet application permet de gerer les activites de CLINIQUE HUGNEY, tel que la gestion des patients, la gestion des stocks des medicaments et les materiels medicaux, ainsi que la gestion des personnelles. Cet application permet aussi de visualiser les statistiques de tous les services (Consultation, Accouchement, etc), le statistique des patients (Sexe, Age, Prse en charge ou non, etc.), et la statistique des maladies. Il permet aussi de faciliter la suivi des assurances pour les patients prise en charge. Il reduit considerablement le temps de gestion de patient dans le Clinique.

            Je suis parmi les 5 personnes pour le developpement de cet application, en assurant le bon fonctionnement de toute la partie Back-end.',
            'advantages' => [
                'Impression vers PDF' => "L'application facilite l'impression de certains fichiers tel que les factures, les resultats d'analyse, le fiche de stock a un moment donne, ainsi aue les ordonnances.",
                'Generation des statistiques' => "Les statistiques des patients par semaine, par mois (Rapport mensuel d'activites) est facile a obtenir qui seront exige par la Ministere de la sante.",
                'Tracabilite des patients' => 'Il est plus facile de tracer les activites des patients au sein du clinique, puisque tous ses informations sont enregistres.'
            ],
            'demo' => 'demo.clinique-hugney.mg'
        ],
        [
            'id' => 2,
            'title' => 'Gestion de stock',
            'technology' => [
                'simple' => 'Laravel 8, VueJS 3, TS',
                'detailed' => 'Laravel pour la partie Back-end, Bootstrap 5 pour la partie CSS, et VueJS pour la partie Front-end'
            ],
            'image' => 'gest-stock.PNG',
            'description' => "Logiciel de gestion de stock permettant de gerer des multiples points de vente et entrepots. Elle facilite le transfert de stock, creation de devise, facture ainsi que le bon de commande. J'etais charge de developper un api avec laravel 8 puis l'integrer avec VueJS 3 au sein de cet application Laravel.",

            'full-description' => "Cet application est une application SPA, permettant de gerer le stock dans des multiples points de vente et entrepots. Elle est developpe en utilisant Laravel 8 pour la partie API et VueJS 3 pour l'integration partie Front-end. Cette application facilite la creation des devis, bon de commande, ainsi que la facturation. A noter qu'elle dispose la possibiliter de transformer directement un devis en bon de commande client ou fournisseur. Elle permet aussi de definir le prix en fonction des entrepots et en fonction des produits nouveau ou ancien dans le stock. Cette application peut etre utilise dans plusieurs secteur d'activites.",

            'advantages' => [
                'Point de vente et entrepot multiple' => 'Permet de faciliter le transfert de stock (entrepot - entrepot, point de vente - entrepot et entrepot - entrepot), et la gestion des points de vente.',
                'Generalisation de gestion' => "Cet application peut etre utilise dans diverses type d'activite et de vente (Devis, Commande, Facturation)."
            ],
            'demo' => 'github.com/rod-car/gestion-stock'
        ],
        [
            'id' => 3,
            'title' => 'e-Katesizy',
            'technology' => [
                'simple' => 'Symfony, React, TS',
                'detailed' => 'API Platform 3 pour la partie API et React pour la partie Front-end avec TypeScript'
            ],
            'image' => 'e-katesizy.PNG',
            'description' => "Single Page Application permettant de gérer les étudiants au niveau de catéchèse. Elle permet de faciliter la gestion des étudiants, la gestion des classes, ainsi que la gestion des personnelles. Cette application est en cours de développement, en utilisant API Platform et React.",

            'full-description' => "Cette application est une application Single Page, permettant de gérer les étudiants en catéchèse d'une paroisse (Sacre cœur Toamasina), mais elle a pour vocation d'être utilise dans plusieurs paroisses. Elle est développée en utilisant API Platform de Symfony pour la partie API et React avec TypeScript pour l'intégration partie Front-end. Cette application facilite le suivi de tous les ainsi que les enseignants.",

            'advantages' => [
                "Traçabilité" => "Permet de tracer facilement les étudiants ainsi que ses parcours.",
                "Adaptable" => "Elle peut être adapte pour plusieurs paroisses."
            ],
            'demo' => 'github.com/rod-car/e-katesizy'
        ],
        [
            'id' => 4,
            'title' => 'e-Karoka',
            'technology' => [
                'simple' => 'Django, Bootstrap, TLN',
                'detailed' => 'Django pour le traitement côte serveur, Bootstrap 5 pour la partie CSS, et la librairie du TLN pour le traitement des documents (Indexation)'
            ],
            'image' => 'e-karoka.PNG',
            'description' => "Moteur de recherche spécialisé dans la recherche des thèses malagasy, permet d'indexer des documents au format PDF, Word et OpenOffice Word. Il dispose d'une recherche par titre, auteur et contenu des documents avec des filtres.",

            'full-description' => "Cette application utilise l'architecture client-serveur, permettant de recherche des thèses malagasy. Elle est développée en utilisant Django 5, et la librairie Spacy du Traitement de Langage Naturel. Cette application facilite l'indexation et la recherches de ces thèses afin de les mieux exploiter. Ce projet est issu de mon mémoire de recherche de Master 2 à l'université de Toamasina.",
            'advantages' => [
                'Soumission décentralisée' => "Chaque étudiant étant connecte peut soumettre directement son document sur le système, en passant par la validation de l'administrateur.",
                "Base sur de l'intelligence artificielle" => "Elle peut être amélioré en utilisant des algorithmes et des modèles plus performants."
            ],
            'demo' => 'github.com/rod-car/e-karoka'
        ]
    ];

    /**
     * @return Project[]
     */
    public static function all () : array
    {
        $projects = [];

        foreach (static::$PROJECTS as $project)
        {
            $projects[] = new Project($project);
        }

        return $projects;
    }


    /**
     * @param integer $id
     * @return Project|null
     */
    public static function find (int $id) : ?Project
    {
        $project = array_values(array_filter(static::$PROJECTS, function ($project) use($id) {
            return $project['id'] === $id;
        }));

        if (count($project) > 0) return new Project($project[0]);

        return null;
    }
}