class SavedProperty {
    private $db;
    public function __construct($db){ $this->db = $db; }

    public function save($user_id, $property_id){
        $stmt = $this->db->prepare("INSERT IGNORE INTO saved_properties (user_id, property_id) VALUES (?,?)");
        return $stmt->execute([$user_id, $property_id]);
    }

    public function findByUser($user_id){
        $stmt = $this->db->prepare("SELECT * FROM saved_properties WHERE user_id=?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}