<?php

/*
 * Une classe qui permet la persistance de données en utilisant
 * un fichier. Plus facile que d'utiliser une vraie base de données,
 * si l'application est simple et si le nombre de personnes
 * connectées en même temps est raisonnable (sinon la manipulation
 * des données ralentit, puisqu'il faut que chacun·e attende
 * son tour).
 *
 * Pour minimiser le temps d'attente, il faut faire le moins
 * de choses possibles entre un appel à loadData() et l'appel
 * à saveData() suivant (car entre les deux, le fichier est verrouillé).
 */
class FileStore {


    /* le nom du fichier dans lequel les données sont sérialisées */
    private $file;
    /* le pointeur de fichier (null si le fichier n'est pas ouvert) */
    private $fp;

    /* Construit une nouvelle instance, qui utilise le fichier donné
     * en paramètre. */
    public function __construct($file) {
        $this->file = $file;
        $this->fp = null;
    }

    public function lockFile() {
        if ($this->fp !== null) {
            /* le fichier est déjà ouvert (et donc verrouillé) */
            return;
        }
        /* ouverture du fichier */
        $this->fp = fopen($this->file, 'a');
        /* verrouillage du fichier */
        if (flock($this->fp, LOCK_EX)) {
            /* on lit le contenu */
            $content = file_get_contents($this->file);
            /* on désérialise le contenu,
             * pour récupérer ce qui y a été stocké  */
            $data = unserialize(base64_decode($content));
            return $data;
        } else {
            throw new Exception('Impossible de verrouiller le fichier "'
                . $this->file . '"');
        }
    }
    public function unlockFile() {
        if ($this->fp === null) {
            /* le fichier n'est pas ouvert, on n'a rien à faire */
            return;
        }
        /* on libère le verrou et on ferme le fichier */
        flock($this->fp, LOCK_UN);
        fclose($this->fp);
        $this->fp = null;
    }

    /*
      * Renvoie les données stockées dans le fichier,
      * et verrouille le fichier (si ce n'est pas déjà fait).
      */
    public function loadData() {
        /* Ouverture et verrouillage du fichier */
        $this->lockFile();
        /* on lit le contenu */
        $content = file_get_contents($this->file);
        /* on désérialise le contenu,
         * pour récupérer ce qui y a été stocké  */
        $data = unserialize(base64_decode($content));
        return $data;
    }

    /*
      * Écrit les données dans le fichier, et libère le verrou.
      */
    public function saveData($data) {
        /* on verrouille le fichier si besoin */
        $this->lockFile();
        if ($data !== null) {
            /* on sérialise le tableau */
            $content = base64_encode(serialize($data));
            /* on remet le curseur au début */
            ftruncate($this->fp, 0);
            /* on écrit le tableau sérialisé */
            fwrite($this->fp, $content);
        }
        /* on libère le verrou et on ferme le fichier */
        $this->unlockFile();
    }

    /*
     * Lors de la destruction de cette instance, on libère le verrou,
     * au cas où ça n'a pas été fait.
     */
    public function __destruct() {
        $this->unlockFile();
    }
}

/*
 * Une classe qui permet de stocker facilement des objets
 * dans un tableau stocké dans un fichier (à l'aide de la classe
 * FileStore). Les méthodes sont proches de l'utilisation
 * d'une table dans une BD.
 */
class ObjectFileDB {

    /* Le FileStore qui permet la persistance des données. */
    private $file_store;

    /* Construit une nouvelle instance, qui utilise le fichier donné
     * en paramètre. Si le fichier n'existe pas, une base vide
     * est créée automatiquement. */
    public function __construct($file) {
        $this->file_store = new FileStore($file);
        if ( ! file_exists($file)) {
            $this->file_store->saveData(array());
        }
    }

    /* Génère un nouvel identifiant aléatoire qui n'existe pas
     * encore dans la BD donnée en paramètre. */
    static private function generate_id($db) {
        do {
            $id = bin2hex(openssl_random_pseudo_bytes(16));
        } while (key_exists($id, $db));
        return $id;
    }

    /* Renvoie true si l'identifiant existe dans la base. */
    public function exists($id) {
        $db = $this->file_store->loadData();
        $this->file_store->unlockFile();
        return key_exists($id, $db);
    }

    /* Insère un objet dans la base. Renvoie l'identifiant
     * aléatoire qui lui a été attribué.
     */
    public function insert($obj) {
        $db = $this->file_store->loadData();
        $id = self::generate_id($db);
        $db[$id] = $obj;
        $this->file_store->saveData($db);
        return $id;
    }

    /* Renvoie l'objet d'identifiant $id.
     * Lance une exception si l'identifiant est inconnu.
     */
    public function fetch($id) {
        $db = $this->file_store->loadData();
        $this->file_store->unlockFile();
        if ( ! key_exists($id, $db)) {
            throw new Exception("Key does not exist");
        }
        return $db[$id];
    }

    /* Renvoie tous les objets de la base dans un tableau
     * associatif { identifiant => objet }.
     */
    public function fetchAll() {
        $db = $this->file_store->loadData();
        $this->file_store->unlockFile();
        return $db;
    }

    /* Supprime l'objet d'identifiant $id de la base.
     * Lance une exception si l'identifiant est inconnu.
     */
    public function delete($id) {
        $db = $this->file_store->loadData();
        if ( ! key_exists($id, $db)) {
            throw new Exception("Key does not exist");
        }
        unset($db[$id]);
        $this->file_store->saveData($db);
    }

    /* Remplace l'objet d'identifiant $id dans la base
     * par celui passé en paramètre.
     * Lance une exception si l'identifiant est inconnu.
     */
    public function update($id, $obj) {
        $db = $this->file_store->loadData();
        if ( ! key_exists($id, $db)) {
            throw new Exception("Key does not exist");
        }
        $db[$id] = $obj;
        $this->file_store->saveData($db);
    }

    /* Supprime tous les objets de la base.
     */
    public function deleteAll() {
        $this->file_store->saveData(array());
    }

}

?>