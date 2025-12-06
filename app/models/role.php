class Role {
    private $db;
    public function __construct($db){ $this->db = $db; }

    public function all(){
        $stmt = $this->db->query("SELECT * FROM roles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}