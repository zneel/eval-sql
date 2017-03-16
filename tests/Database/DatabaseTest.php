<?php
namespace Tests\Database;
use PHPUnit\Framework\TestCase;
use Simplon\Database\Database;

/**
 * Created by PhpStorm.
 * User: highroad
 * Date: 13/03/2017
 * Time: 10:01
 */
final class DatabaseTest extends TestCase
{
    /**
     * @return Database
     * Get PDO instance and queries methods
     */
    public function getConnection()
    {
        $database = 'eval_ecommerce';
        $user = 'root';
        $password = 'root';
        $port = 3306;
        $pdo = new Database('localhost', $user, $password, $port, $database);
        return $pdo;
    }

    /**
     * Afficher les noms et prénoms de tous les utilisateurs qui habitent à Saint-Pierre
     */
    public function testShowFirstNameLastNameOfUsersLivingStPierre()
    {
        $expected = [
            [
                "id" => 1,
                "gender" => 'M.',
                "firstname" => 'Fusce',
                "lastname" => 'Semper',
                "email" => 'fusce.semper@mail.com',
                "phone" => '0262112233',
                "address" => '12 rue Cras eu pulvinar',
                "zipcode" => '97410',
                "city" => 'Saint-Pierre'
            ],
            [
                "id" => 2,
                "gender" => 'Mme',
                "firstname" => 'Nulla',
                "lastname" => 'Enim',
                "email" => 'nulla.enim@mail.com',
                "phone" => '0262223344',
                "address" => '66 avenue efficitur vitae',
                "zipcode" => '97410',
                "city" => 'Saint-Pierre'
            ]
        ];
        $db = $this->getConnection();
        $res = $db->showFirstNameLastNameOfUsersLivingStPierre();
        $this->assertEquals($expected, $res);
    }

    /**
     * Afficher les noms, prénoms, email de toutes les utilisatrices
     */
    public function testShowLastNameFirstNameEmailFemaleUsers()
    {
        $expected = [
            [
                "firstname" => 'Nulla',
                "lastname" => 'Enim',
                "email" => 'nulla.enim@mail.com',
            ],
            [
                "firstname" => 'Elementum',
                "lastname" => 'Leo',
                "email" => 'elementum.leo@mail.com',
            ],
            [
                "firstname" => 'Mattis',
                "lastname" => 'Amet',
                "email" => 'mattis.amet@mail.com',
            ],
            [
                "firstname" => 'Eget',
                "lastname" => 'Viverra',
                "email" => 'eget.vivera@mail.com',
            ],
        ];
        $db = $this->getConnection();
        $res = $db->showLastNameFirstNameEmailFemaleUsers();
        $this->assertEquals($expected, $res);
    }

    /**
     * Afficher les noms, prénoms et téléphone de tous les utilisateurs qui ont
     * enregistrés un numéro de téléphone fixe (commençant par 0262)
     */
    public function testShowLastNameFirstNamePhoneWhereNumberStartsBy0262()
    {
        $expected = [
            [
                "lastname" => 'Semper',
                "firstname" => 'Fusce',
                "phone" => '0262112233',
            ],
            [
                "lastname" => 'Enim',
                "firstname" => 'Nulla',
                "phone" => '0262223344',
            ],
            [
                "lastname" => 'Amet',
                "firstname" => 'Mattis',
                "phone" => '0262147896',
            ],
            [
                "lastname" => 'Neque',
                "firstname" => 'Maecena',
                "phone" => '0262357159',
            ],
        ];
        $db = $this->getConnection();
        $res = $db->showLastNameFirstNamePhoneWhereNumberStartsBy0262();
        $this->assertEquals($expected, $res);
    }

    /**
     * Afficher le prix du produit le plus cher et le prix du produit le moins cher
     */
    public function testShowMinAndMaxProductPrice()
    {
        $expected = [
            [
                "MIN PRICE" => 10.00,
                "MAX PRICE" => 9999.99,
            ],
        ];
        $db = $this->getConnection();
        $res = $db->showMinAndMaxProductPrice();
        $this->assertEquals($expected, $res);
    }

    /**
     * Afficher toutes les commandes passées en 2016.
     * Vous devez afficher le prénom, nom, email, la date de commande et id de la commande :
     */
    public function testShowAll2016Orders()
    {
        $expected = [
            [
                "firstname" => 'Fusce',
                "lastname" => 'Semper',
                "email" => 'fusce.semper@mail.com',
                "orderedAt" => '2016-11-23 08:00:00',
                "order_id" => '1'
            ],
            [
                "firstname" => 'Fusce',
                "lastname" => 'Semper',
                "email" => 'fusce.semper@mail.com',
                "orderedAt" => '2016-12-06 18:30:00',
                "order_id" => '2'
            ],
            [
                "firstname" => 'Fusce',
                "lastname" => 'Semper',
                "email" => 'fusce.semper@mail.com',
                "orderedAt" => '2016-12-23 23:15:00',
                "order_id" => '3'
            ],
        ];
        $db = $this->getConnection();
        $res = $db->showAll2016Orders();
        $this->assertEquals($expected, $res);
    }

    /**
     * Afficher toutes les commandes du matin (entre 6h et 12h).
     * Vous devez afficher le prénom, nom, email, date de commande et id de la commande :
     */
    public function testshowAllOrdersBetween6and12()
    {
        $expected = [
            [
                "firstname" => 'Fusce',
                "lastname" => 'Semper',
                "email" => 'fusce.semper@mail.com',
                "orderedAt" => '2016-11-23 08:00:00',
                "order_id" => '1'
            ],
            [
                "firstname" => 'Nulla',
                "lastname" => 'Enim',
                "email" => 'nulla.enim@mail.com',
                "orderedAt" => '2017-01-02 06:48:00',
                "order_id" => '4'
            ],
            [
                "firstname" => 'Maximus',
                "lastname" => 'Urna',
                "email" => 'maximus.urna@mail.com',
                "orderedAt" => '2017-01-08 09:15:00',
                "order_id" => '5'
            ],
            [
                "firstname" => 'Mattis',
                "lastname" => 'Amet',
                "email" => 'mattis.amet@mail.com',
                "orderedAt" => '2017-01-11 12:01:00',
                "order_id" => '9'
            ],
        ];
        $db = $this->getConnection();
        $res = $db->showAllOrdersBetween6and12();
        $this->assertEquals($expected, $res);
    }

    /**
     * Afficher toutes les commandes du soir (entre 18h et 23h59).
     * Vous devez afficher le prénom, nom, email, date de commande et id de la commande :
     */
    public function testShowAllOrdersBetween18and2359()
    {
        $expected = [
            [
                "firstname" => 'Fusce',
                "lastname" => 'Semper',
                "email" => 'fusce.semper@mail.com',
                "orderedAt" => '2016-12-06 18:30:00',
                "order_id" => '2'
            ],
            [
                "firstname" => 'Fusce',
                "lastname" => 'Semper',
                "email" => 'fusce.semper@mail.com',
                "orderedAt" => '2016-12-23 23:15:00',
                "order_id" => '3'
            ],
            [
                "firstname" => 'Nulla',
                "lastname" => 'Enim',
                "email" => 'nulla.enim@mail.com',
                "orderedAt" => '2017-01-08 19:15:00',
                "order_id" => '7'
            ],
        ];
        $db = $this->getConnection();
        $res = $db->showAllOrdersBetween18and2359();
        $this->assertEquals($expected, $res);
    }

    /**
     * Trouver les utilisateurs qui n'ont passés aucune commande et
     * affichez leur id, prénom, nom et email
     */
    public function testShowAllUsersHaventOrdered()
    {
        $expected = [
            [
                "id" => '7',
                "firstname" => 'Maecena',
                "lastname" => 'Neque',
                "email" => 'maecena.neque@mail.com',
            ],
            [
                "id" => '8',
                "firstname" => 'Eget',
                "lastname" => 'Viverra',
                "email" => 'eget.vivera@mail.com',
            ],
        ];
        $db = $this->getConnection();
        $res = $db->showAllUsersHaventOrdered();
        $this->assertEquals($expected, $res);
    }

    /**
     * Afficher tous les clients qui ont passés 3 commandes ou plus.
     * Afficher leur id, prénom, nom, email et le nombre de commandes passés.
     */
    public function testShowAllCustomersOrdered3OrMore()
    {
        $expected = [
            [
                "id" => '1',
                "firstname" => 'Fusce',
                "lastname" => 'Semper',
                "email" => 'fusce.semper@mail.com',
                "nombre_commandes" => '3'
            ],
            [
                "id" => '3',
                "firstname" => 'Maximus',
                "lastname" => 'Urna',
                "email" => 'maximus.urna@mail.com',
                "nombre_commandes" => '3'
            ],
            [
                "id" => '5',
                "firstname" => 'Ipsum',
                "lastname" => 'Sagittis',
                "email" => 'ipsum.sagittis@mail.com',
                "nombre_commandes" => '3'
            ],
            [
                "id" => '6',
                "firstname" => 'Mattis',
                "lastname" => 'Amet',
                "email" => 'mattis.amet@mail.com',
                "nombre_commandes" => '3'
            ],
        ];
        $db = $this->getConnection();
        $res = $db->showAllCustomersOrdered3OrMore();
        $this->assertEquals($expected, $res);
    }

    /**
     * Afficher les 2 produits les plus commandés
     */
    public function testShowTwoMostOrderedProducts()
    {
        $expected = [
            [
                "id" => '1',
                "name" => 'TV Lorem ipsum',
                "quantity" => '2',
            ],
            [
                "id" => '2',
                "name" => 'Curabitur sit',
                "quantity" => '4',
            ],
        ];
        $db = $this->getConnection();
        $res = $db->showTwoMostOrderedProducts();
        $this->assertEquals($expected, $res);
    }
}