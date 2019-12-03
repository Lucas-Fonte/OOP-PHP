<?php 

    class Product { 
        public $name = "teste";
        public $qtd = 2;

        public function handleRequest(){
            $request = $_SERVER["QUERY_STRING"];

            if ( $request !== null ){
                return $request;
            } else {
                return "no request";
            }
        }

        public function handleGitHub(){
            $opts = [
                    'http' => [
                            'method' => 'GET',
                            'header' => [
                                    'User-Agent: PHP'
                            ]
                    ]
            ];
        
            $context = stream_context_create($opts);
            $content = json_decode(file_get_contents("https://api.github.com/users/Lucas-Fonte", false, $context));
            return [
                        "avatar"=>$content->avatar_url,
                        "user"=>$content->login
                   ];
        }
    }

    $test = new Product();

    echo json_encode([
        "name"=>$test->name, 
        "qtd"=> $test->qtd,
        "server"=> $_SERVER['HTTP_HOST'],
        "request"=> $test->handleRequest(),
        "github"=> $test->handleGitHub(),
        "teste"=> [
            "thisTeste"=>"teste",
            "thisProp"=>"prop"
        ]
        ]);

?>