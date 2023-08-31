<?php


Jenu::command('test', function(){
    $testToken = json_encode([
        'tokenSaveInDB' => bin2hex(random_bytes(32)),
        'payload' => [
            'id' => 1
        ]
    ]);


    Jenu::success("The token is: $testToken");
    Jenu::success("The key is: ".$_ENV['APP_KEY']);
    $encryptTestToken =  import('Encrypt/encrypt.php', true, '/core')->encrypt($testToken, $_ENV['APP_KEY']);
    Jenu::success("The token encrypt is: $encryptTestToken");
    $decryptTestToken = import('Encrypt/encrypt.php', true, '/core')->decrypt($encryptTestToken, $_ENV['APP_KEY']);
    Jenu::success("The token decrypt is: $decryptTestToken");

    $token = "d5qfBetgd8CJdikL5BK4ZRiKWEMG%2Fd%2FV8TkfHyVTcEKcy2nqkqZRnqBGVBylwDpzaN7LTA7teGHelH6aTaEuZYlz0cpWWBUdw0fDpqBjNP%2FjTI7SSCYbv9uSN0Qq5mwN";
    $token = "W+uha6aaWuJpGDYmKm3nIZ3n2NtqKWdm2mhubTIlaSo1oy3n8xzyauGlpqLntW422XQjJZil4SPeJGvi7hprIdohaua24jVsaNtfF+f0Zd5lKh6fZ2qjM9namprpbun06ajt7CytJC3iLPQfXZ0hWWt2I1nrZC8dXGqgISmr42th5dooGt7jpihl8ebpKGriJKMb8RqdJigYpfbrI6qfKHbzL6u08nHm7t61aq5t4uWeKOjvZ7SprmczKmUl6Bpupqo3o3Hi6tmim6Wm8aagoGBloGZioHchZKmqaCfyn6CrK1vptS41qfGlqnKgMlfmt5ljn6OarS51YiycdabZQ==";
    $token = "pJOVfWSjm6GqXoqJgXJ3lIFpfXWci5KVgIWrf6KfY4JdhX6VXodqYoqbZ3R9qXOTpWKGa4mkeZ%2BJpmOWiHqfhJxonqZ6a5iMp2R%2BfnNja4GDon2XY52VoWN5mp57eZ2ofqJ0nKB6Yotnq5h8pp%2BbXmN%2FdmJ6Z5Z1e3hzip2rpJmmY1yjo1yVeGh4hn2aeWZ3YpSriIeZcG4%3D";

    $decryptTestToken = import('Encrypt/encrypt.php', true, '/core')->decrypt($token, $_ENV['APP_KEY']);
    Jenu::success("The token decrypt is: $decryptTestToken");
});