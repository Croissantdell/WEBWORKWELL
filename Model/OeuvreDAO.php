<?php

require_once 'OeuvreBO.php';

class OeuvreDAO {
    private PDO $db;

    public function __construct(PDO $database) {
        $this->db = $database;
    }

    public function getOeuvreById($id): OeuvreBO {
        $sql = "SELECT * FROM oeuvre WHERE codeOeuvre = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new OeuvreBO(
                $row['codeOeuvre'],
                $row['titreOriginalOeuvre'],
                $row['titreFrancaisOeuvre'],
                $row['anneeSortieOeuvre'],
                $row['resumeOeuvre'],
                $row['nbEpisodeOeuvre'],
                $row['affiche']
            );
        }

        throw new Exception("Oeuvre not found");
    }

    public function getLatestOeuvres(int $limit = 3): array {
        $query = "SELECT * FROM oeuvre ORDER BY anneeSortieOeuvre DESC LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createOeuvre(string $titreOriginalOeuvre, string $titreFrancaisOeuvre, int $anneeSortieOeuvre, string $resumeOeuvre, int $nbEpisodeOeuvre, string $affiche): string {
        $sql = "INSERT INTO oeuvre (titreOriginalOeuvre, titreFrancaisOeuvre, anneeSortieOeuvre, resumeOeuvre, nbEpisodeOeuvre, affiche) VALUES (:titreOriginalOeuvre, :titreFrancaisOeuvre, :anneeSortieOeuvre, :resumeOeuvre, :nbEpisodeOeuvre, :affiche)";
        $stmt = $this->db->prepare($sql);
        $params = [
            ':titreOriginalOeuvre' => $titreOriginalOeuvre,
            ':titreFrancaisOeuvre' => $titreFrancaisOeuvre,
            ':anneeSortieOeuvre' => $anneeSortieOeuvre,
            ':resumeOeuvre' => $resumeOeuvre,
            ':nbEpisodeOeuvre' => $nbEpisodeOeuvre,
            ':affiche' => $affiche,
        ];
        $stmt->execute($params);

        return $this->db->lastInsertId();
    }

    public function deleteOeuvre(int $id): bool {
        try {
            $this->db->beginTransaction();

            $sql = "DELETE FROM jouer WHERE codeOeuvre = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);

            $sql = "DELETE FROM oeuvre_classification WHERE codeOeuvre = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);

            $sql = "DELETE FROM oeuvre_genre WHERE codeOeuvre = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);

            $sql = "DELETE FROM realiser WHERE codeOeuvre = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);

            $sql = "DELETE FROM oeuvre WHERE codeOeuvre = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getAllOeuvres(): array {
        $sql = "SELECT * FROM oeuvre";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function associerClassification($codeClassification, $codeOeuvre): bool {
        $sql = "INSERT INTO oeuvre_classification (codeClassification, codeOeuvre) VALUES (:codeClassification, :codeOeuvre)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':codeClassification' => $codeClassification, ':codeOeuvre' => $codeOeuvre]);
    }

    public function associerGenre($idGenre, $codeOeuvre): bool {
        $sql = "INSERT INTO oeuvre_genre (idGenre, codeOeuvre) VALUES (:idGenre, :codeOeuvre)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':idGenre' => $idGenre, ':codeOeuvre' => $codeOeuvre]);
    }

    public function getAllOeuvresdiff($search = null, $sort = null, $filter = null): array {
        $query = "SELECT * FROM oeuvre";
        $params = [];

        if ($search) {
            $query .= " WHERE titreFrancaisOeuvre LIKE :search";
            $params[':search'] = "%$search%";
        }

        if ($filter) {
            $filterQuery = "";
            if ($filter === 'anime') {
                $filterQuery = "SELECT codeOeuvre FROM oeuvre_classification WHERE codeClassification = '02'";
            } elseif ($filter === 'film') {
                $filterQuery = "SELECT codeOeuvre FROM oeuvre_classification WHERE codeClassification = '01'";
            } elseif ($filter === 'serie') {
                $filterQuery = "SELECT codeOeuvre FROM oeuvre_classification WHERE codeClassification = '03'";
            }
            $query .= ($search ? " AND" : " WHERE") . " codeOeuvre IN ($filterQuery)";
        }

        if ($sort && $sort === 'date') {
            $query .= " ORDER BY anneeSortieOeuvre DESC";
        }

        $stmt = $this->db->prepare($query);

        if ($search) {
            $stmt->bindParam(':search', $params[':search'], PDO::PARAM_STR);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOeuvre(
        int $codeOeuvre,
        string $titreOriginalOeuvre,
        string $titreFrancaisOeuvre,
        int $anneeSortieOeuvre,
        string $resumeOeuvre,
        int $nbEpisodeOeuvre,
        string $affiche,
        array $acteurs,
        array $realisateurs,
        array $genres,
        array $classifications
    ) {
        $sql = "UPDATE oeuvre SET titreOriginalOeuvre = ?, titreFrancaisOeuvre = ?, anneeSortieOeuvre = ?, resumeOeuvre = ?, nbEpisodeOeuvre = ?, affiche = ? WHERE codeOeuvre = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $titreOriginalOeuvre,
            $titreFrancaisOeuvre,
            $anneeSortieOeuvre,
            $resumeOeuvre,
            $nbEpisodeOeuvre,
            $affiche,
            $codeOeuvre
        ]);

        $this->updateRelations('jouer', 'idActeur', $codeOeuvre, $acteurs);
        $this->updateRelations('realiser', 'idRealisateur', $codeOeuvre, $realisateurs);
        $this->updateRelations('oeuvre_genre', 'idGenre', $codeOeuvre, $genres);
        $this->updateRelations('oeuvre_classification', 'codeClassification', $codeOeuvre, $classifications);
    }

    private function updateRelations(string $table, string $column, int $codeOeuvre, array $items) {
        $this->db->exec("DELETE FROM $table WHERE codeOeuvre = $codeOeuvre");
        foreach ($items as $item) {
            $stmt = $this->db->prepare("INSERT INTO $table (codeOeuvre, $column) VALUES (?, ?)");
            $stmt->execute([$codeOeuvre, $item]);
        }
    }
}
?>
