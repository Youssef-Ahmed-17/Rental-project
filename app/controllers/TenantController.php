class TenantController extends Controller {
    private $propertyModel, $savedModel, $applicationModel;
    public function __construct(){
        $this->propertyModel = new Property($this->db);
        $this->savedModel = new SavedProperty($this->db);
        $this->applicationModel = new Application($this->db);
    }

    public function dashboard(){
        $properties = $this->propertyModel->all();
        $this->view('tenant/dashboard', ['properties'=>$properties]);
    }

    public function propertyList(){
        $properties = $this->propertyModel->all();
        $this->view('tenant/property-list', ['properties'=>$properties]);
    }

    public function propertyDetail($id){
        $property = $this->propertyModel->find($id);
        $images = (new PropertyImage($this->db))->findByProperty($id);
        $this->view('tenant/property-detail', ['property'=>$property,'images'=>$images]);
    }

    public function applyProperty($id){
        if($_POST){
            $this->applicationModel->create([
                'property_id'=>$id,
                'tenant_id'=>$_SESSION['user_id'],
                'note'=>$_POST['note'] ?? ''
            ]);
            header("Location: /tenant/dashboard"); exit;
        }
        $property = $this->propertyModel->find($id);
        $this->view('tenant/apply-property', ['property'=>$property]);
    } }