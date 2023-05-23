<?php

// Definisikan fungsi untuk memeriksa apakah kata diterima oleh NFA
function nfa($word)
{
    $currentState = ['q0']; // State awal
    $finalState = ['q2']; // State akhir

    // Tabel transisi NFA
    $transitions = [
        'q0' => [
            'b' => ['q1']
        ],
        'q1' => [
            'a' => ['q2'],
            'b' => ['q2']
        ],
        'q2' => [
            'b' => ['q2']
        ]
    ];

    // Loop melalui setiap karakter dalam kata
    for ($i = 0; $i < strlen($word); $i++) {
        $input = $word[$i]; // Karakter saat ini
        $nextState = []; // State berikutnya

        // Loop melalui setiap state saat ini
        foreach ($currentState as $state) {
            // Periksa apakah ada transisi yang sesuai dengan input karakter
            if (isset($transitions[$state][$input])) {
                // Tambahkan state berikutnya ke himpunan state berikutnya
                $nextState = array_merge($nextState, $transitions[$state][$input]);
            }
        }

        // Perbarui state saat ini dengan state berikutnya
        $currentState = $nextState;
    }

    // Periksa apakah ada setidaknya satu state saat ini yang merupakan state akhir
    foreach ($currentState as $state) {
        if (in_array($state, $finalState)) {
            return true; // Kata diterima
        }
    }

    return false; // Kata ditolak
}

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $word = $_POST["word"]; // Kata yang diinputkan melalui form

    // Panggil fungsi nfa untuk memeriksa kata
    if (nfa($word)) {
        $result = "$word diterima oleh NFA";
    } else {
        $result = "$word ditolak oleh NFA";
    }
} else {
    $result = ""; // Set hasil awal menjadi kosong
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Form NFA</title>
    <style>
        body {
            background-image: url("https://cdn.wallpapersafari.com/78/99/6GTXAf.jpg");
            background-attachment: fixed;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
         }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }

        label {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"] {
            padding: 10px;
            width: 200px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        p {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
<h1>Form NFA</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="word">Masukkan kata:</label>
        <input type="text" id="word" name="word">
        <input type="submit" value="Cek">
    </form>

    <p><?php echo $result; ?></p>
</body
</html>     
    </style
</head>
<body>