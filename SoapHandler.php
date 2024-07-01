<?php

namespace MyApp;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class SoapHandler {
    private $db;
    private $secretKey = 'your_secret_key';

    public function __construct($db) {
        $this->db = $db;
    }

    public function getProducts($params) {
        $token = $params->token;
        
        // Decode JWT
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            $page = $params->page;
            $limit = $params->limit;
            $offset = $page * $limit;
            $query = "SELECT * FROM products LIMIT ?, ?";
            $result = $this->db->query($query, ['ii', $offset, $limit]);
            return $result;
        } catch (\Exception $e) {
            throw new \SoapFault('Server', 'Invalid token: ' . $e->getMessage());
        }
    }
}
