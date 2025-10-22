<?php
session_start();
header('Content-Type: application/json');
$response = [
    'status' => 'error',
    'message' => 'This is default response'
];

$host = 'localhost';
$db = 'year4_midterm_modals';
$dsn = "mysql:host={$host};dbname={$db};charset=utf8mb4";

$user = 'root';
$pass = '';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'DB connection failed. . . ']);
    exit;
}


$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? null;

switch ($action) {
    case 'create':
        $username = trim($input['username'] ?? '');
        $firstname = trim($input['firstname'] ?? '');
        $lastname = trim($input['lastname'] ?? '');
        $password = trim($input['password'] ?? '');
        $confirm_password = trim($input['confirm_password'] ?? '');
        $is_admin = $input['is_Admin'];

        // check empty inputs
        if (!empty($username) && !empty($firstname) && !empty($lastname) && !empty($password) && !empty($confirm_password) && !empty($is_admin)) {
            
            // check username
            $stmt = $pdo->prepare("SELECT COUNT(*) as username_count FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $count = $stmt->fetch();

            if ($count['username_count'] == 0) {
                
                // check password
                if ($password === $confirm_password) {
                    $pass_hash = password_hash($password, PASSWORD_DEFAULT);

                    $stmt = $pdo->prepare("INSERT INTO users (username, firstname, lastname, password, is_admin) VALUES (?,?,?,?,?)");
                    $register = $stmt->execute([$username, $firstname, $lastname, $pass_hash, $is_admin]);

                    if ($register) {
                        $response = [
                            'status' => 'success',
                            'message' => 'Registration successful!'
                        ];
                    } else {
                        $response = [
                            'status' => 'success',
                            'message' => 'Registration failed. . . '
                        ];
                    }

                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Passwords not the same'
                    ];
                }

            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Username already taken'
                ];
            }

        } else {
            $response = [
                'status' => 'error',
                'message' => 'All fields must be provided'
            ];
        }

        echo json_encode($response);
        break;
    
    case 'read':
        # code...
        break;
    
    case 'update':
        # code...
        break;
    
    case 'delete':
        # code...
        break;
    
    case 'login':
        $username = trim($input['username'] ?? '');
        $password = trim($input['password'] ?? '');

        // check empty inputs
        if (!empty($username) && !empty($password)) {
            
            // check username exists
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user) {

                // check password
                if (password_verify($password, $user['password'])) {
                    
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['is_admin'] = $user['is_admin'];

                    $response = [
                        'status' => 'success',
                        'message' => 'Login successful.',
                        'is_admin' => $user['is_admin']
                    ];

                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Incorrect password'
                    ];
                }

            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'User not yet registered'
                ];
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'All fields must be provided'
            ];
        }
        
        echo json_encode($response);
        break;
    
    case 'logout':
        session_start();
        session_unset();
        session_destroy();

        $response = [
            'status' => 'success',
            'message' => 'Logged out successfully.'
        ];

        ob_clean();
        echo json_encode($response);
        break;

    default:
        $response = [
            'status' => 'error',
            'message' => 'Invalid action'
        ];
        echo json_encode($response);
        break;
}

?>