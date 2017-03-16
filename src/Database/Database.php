<?php
namespace Simplon\Database;
use PDO;
use PDOException;

/**
 * Created by PhpStorm.
 * User: highroad
 * Date: 13/03/2017
 * Time: 09:51
 */

final class Database
{
    private $host;
    private $username;
    private $password;
    private $port;
    private $dbname;

    public function __construct($host = 'localhost', $username, $password, $port = 3306, $dbname)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
        $this->dbname = $dbname;
    }

    /**
     * Connect Method for PDO
     */
    public function connect()
    {
        try {
            $this->host;
            $dbh = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->username, $this->password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $dbh;
    }

    /**
     * @return array
     * Afficher les noms et prénoms de tous les utilisateurs qui habitent à Saint-Pierre
     */
    public function showFirstNameLastNameOfUsersLivingStPierre()
    {
        //on écrit notre requete SQL
        $query = 'SELECT * FROM customers WHERE customers.city = \'Saint-Pierre\'';
        //on initialise la connection a la bdd
        $db = $this->connect();
        //on prepare la requete
        $sth = $db->prepare($query);
        //on execute la requete
        $sth->execute();
        //on retourne le resultat de la requete sous forme clef=>valeur
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     * Afficher les noms, prénoms, email de toutes les utilisatrices
     */
    public function showLastNameFirstNameEmailFemaleUsers()
    {
        //on écrit notre requete SQL
        $query = 'SELECT lastname, firstname, email 
                  FROM customers 
                  WHERE customers.gender = \'Mme\'';
        //on initialise la connection a la bdd
        $db = $this->connect();
        //on prepare la requete
        $sth = $db->prepare($query);
        //on execute la requete
        $sth->execute();
        //on retourne le resultat de la requete sous forme clef=>valeur
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     * Afficher les noms, prénoms et téléphone de tous les utilisateurs qui ont
     * enregistrés un numéro de téléphone fixe (commençant par 0262)
     */
    public function showLastNameFirstNamePhoneWhereNumberStartsBy0262()
    {
        //on écrit notre requete SQL
        $query = 'SELECT lastname, firstname, phone 
                  FROM customers 
                  WHERE customers.phone 
                  LIKE \'%0262%\'';
        //on initialise la connection a la bdd
        $db = $this->connect();
        //on prepare la requete
        $sth = $db->prepare($query);
        //on execute la requete
        $sth->execute();
        //on retourne le resultat de la requete sous forme clef=>valeur
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     * Afficher le prix du produit le plus cher et le prix du produit le moins cher
     */
    public function showMinAndMaxProductPrice()
    {
        //on écrit notre requete SQL
        $query = 'SELECT MIN(price) AS \'MIN PRICE\', MAX(price) AS \'MAX PRICE\'
                  FROM products';
        //on initialise la connection a la bdd
        $db = $this->connect();
        //on prepare la requete
        $sth = $db->prepare($query);
        //on execute la requete
        $sth->execute();
        //on retourne le resultat de la requete sous forme clef=>valeur
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     * Afficher toutes les commandes passées en 2016.
     * Vous devez afficher le prénom, nom, email, la date de commande et id de la commande :
     */
    public function showAll2016Orders()
    {
        //on écrit notre requete SQL
        $query = 'SELECT c.firstname, c.lastname, c.email, o.orderedAt, o.id AS order_id
                  FROM orders AS o
                  JOIN customers AS c
                  ON c.id = o.customers_id
                  WHERE o.orderedAt 
                  LIKE \'%2016%\'';
        //on initialise la connection a la bdd
        $db = $this->connect();
        //on prepare la requete
        $sth = $db->prepare($query);
        //on execute la requete
        $sth->execute();
        //on retourne le resultat de la requete sous forme clef=>valeur
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     * Afficher toutes les commandes du matin (entre 6h et 12h).
     * Vous devez afficher le prénom, nom, email, date de commande et id de la commande :
     */
    public function showAllOrdersBetween6and12()
    {
        //on écrit notre requete SQL
        $query = 'SELECT c.firstname, c.lastname, c.email, o.orderedAt, o.id AS order_id
                  FROM orders AS o
                  JOIN customers AS c
                  ON c.id = o.customers_id
                  WHERE HOUR(o.orderedAt)
                  BETWEEN 6 AND 12';
        //on initialise la connection a la bdd
        $db = $this->connect();
        //on prepare la requete
        $sth = $db->prepare($query);
        //on execute la requete
        $sth->execute();
        //on retourne le resultat de la requete sous forme clef=>valeur
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     * Afficher toutes les commandes du soir (entre 18h et 23h59).
     * Vous devez afficher le prénom, nom, email, date de commande et id de la commande :
     */
    public function showAllOrdersBetween18and2359()
    {
        //on écrit notre requete SQL
        $query = 'SELECT c.firstname, c.lastname, c.email, o.orderedAt, o.id AS order_id
                  FROM orders AS o
                  JOIN customers AS c
                  ON c.id = o.customers_id
                  WHERE HOUR(o.orderedAt)
                  BETWEEN 18 AND 23
                  AND MINUTE(o.orderedAt)
                  BETWEEN 00 AND 59';
        //on initialise la connection a la bdd
        $db = $this->connect();
        //on prepare la requete
        $sth = $db->prepare($query);
        //on execute la requete
        $sth->execute();
        //on retourne le resultat de la requete sous forme clef=>valeur
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     * Trouver les utilisateurs qui n'ont passés aucune commande et
     * affichez leur id, prénom, nom et email
     */
    public function showAllUsersHaventOrdered()
    {
        //on écrit notre requete SQL
        $query = 'SELECT c.id, c.firstname, c.lastname, c.email
                  FROM customers AS c
                  LEFT JOIN orders AS o
                  ON c.id = o.customers_id
                  WHERE o.customers_id IS NULL';
        //on initialise la connection a la bdd
        $db = $this->connect();
        //on prepare la requete
        $sth = $db->prepare($query);
        //on execute la requete
        $sth->execute();
        //on retourne le resultat de la requete sous forme clef=>valeur
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     * Afficher tous les clients qui ont passés 3 commandes ou plus.
     * Afficher leur id, prénom, nom, email et le nombre de commandes passés.
     */
    public function showAllCustomersOrdered3OrMore()
    {
        //on écrit notre requete SQL
        $query = 'SELECT c.id, c.firstname, c.lastname, c.email, 
                  COUNT(o.customers_id) AS nombre_commandes
                  FROM customers AS c
                  LEFT JOIN orders AS o
                  ON c.id = o.customers_id
                  GROUP BY o.customers_id
                  HAVING COUNT(o.customers_id) >= 3';
        //on initialise la connection a la bdd
        $db = $this->connect();
        //on prepare la requete
        $sth = $db->prepare($query);
        //on execute la requete
        $sth->execute();
        //on retourne le resultat de la requete sous forme clef=>valeur
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     * Afficher les 2 produits les plus commandés
     */
    public function showTwoMostOrderedProducts()
    {
        //on écrit notre requete SQL
        $query = 'SELECT p.id, p.name, SUM(oI.quantity) AS quantity 
                  FROM orderItems AS oI
                  LEFT JOIN products AS p
                  ON oI.products_id = p.id
                  GROUP BY products_id 
                  LIMIT 2';
        //on initialise la connection a la bdd
        $db = $this->connect();
        //on prepare la requete
        $sth = $db->prepare($query);
        //on execute la requete
        $sth->execute();
        //on retourne le resultat de la requete sous forme clef=>valeur
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
