<?php
class AdminController extends Controller {

    public function dashboard() {
        $user = $this->model('User');
        $post = $this->model('Post');
        $req  = $this->model('Request');

        $data = [
            'registeredUsers' => $user->countByStatus(), // الآن يعمل بدون مشاكل
            'approvedPosts'   => $post->countByStatus('Approved'),
            'inactivePosts'   => $post->countByStatus('Inactive'),
            'removedPosts'    => $post->countByStatus('Removed'),
            'pendingRequests' => $req->countByStatus('Pending')
        ];

        $this->view('admin/adminDashboard', $data);
    }

    public function manageUsers() {
        $user = $this->model('User');
        $users = $user->getAll();
        $this->view('admin/manageUsers', ['users' => $users]);
    }

    public function managePosts() {
        $post = $this->model('Post');
        $posts = $post->getAll();
        $this->view('admin/managePosts', ['posts' => $posts]);
    }

    public function manageRequests() {
        $req = $this->model('Request');
        $requests = $req->getAll();
        $this->view('admin/manageRequests', ['requests' => $requests]);
    }

    // نقطة نهاية AJAX لتحديث الحالة
    public function updateStatus() {
        if (isset($_GET['action'], $_GET['id'], $_GET['status'])) {
            $action = $_GET['action'];
            $id     = $_GET['id'];
            $status = $_GET['status'];

            switch ($action) {
                case 'updateUserStatus':
                    $this->model('User')->updateStatus($id, $status);
                    break;
                case 'updatePostStatus':
                    $this->model('Post')->updateStatus($id, $status);
                    break;
                case 'updateRequestStatus':
                    $this->model('Request')->updateStatus($id, $status);
                    break;
            }

            echo json_encode(['success' => true]);
            exit;
        }
    }
}
