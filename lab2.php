<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab 2</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td {
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    function display_array($arr, $title) {
        echo "<table><th colspan='100%'>$title</th>";
        for ($i = 0; $i < count($arr); $i++) {
            for ($row = 0; $row < count($arr[0][0]); $row++) {
                $span = count($arr[0][0][0]);
                if ($row == 0) {
                    echo "<tr>";
                    for ($j = 0; $j < count($arr[0]); $j++) {
                        echo "<th colspan='$span'>3d matrix[$i][$j]</th>";
                    }
                    echo "</tr>";
                }
                echo "<tr>";
                for ($j = 0; $j < count($arr[0]); $j++) {

                    for ($k = 0; $k < $span; $k++) {
                        echo "<td>" . implode(", ", $arr[$i][$j][$row][$k]) . "</td>";
                    }
                }
                echo "</tr>";
            }
        }
        echo "</table>";
    };

    $original_arr = [
        [
            [
                [[1, 2], [2.254, "mimi"], [3, 6]],
                [['a'], ['b'], ['c']],
                [["lol"], ["kek"], ["lel"]]
            ],
            [
                [[1, 2], [2.254, "mimi"], [3, 6]],
                [['c'], ['b'], ['a']],
                [["lol"], ["kek"], ["lel"]]
            ]
        ],
        [
            [
                [[1, 2], [2.254, "mimi"], [3, 6]],
                [['b'], ['d'], ['c']],
                [[63, 1], ["kek"], [65092, 23906, 2945]]
            ],
            [
                [["meow meow"], ["fgsfds", "kekeke"], [43, 2]],
                [[29.05828], [9.298451], [3.30591]],
                [[3, 5], [7, 29], [62, 3]]
            ]
        ]
    ];
    
    $sorted_arr = array_map(function($el5) {
        return array_map(function($el4) {
            $new_el4 = array_map(function($el3) {
                $new_el3 = array_map(function($el2) {
                    $without_ints = array_filter($el2, function($el) {
                        return (!is_integer($el));
                    });
                    
                    $uppercase_strings = array_map(function($el) {
                        if (is_string($el)) {
                            return strtoupper($el);
                        }
                        else if (is_float($el)) {
                            $el = round($el, 2);
                            return $el;
                        }
                        else {
                            return $el;
                        }
                    }, $without_ints);

                    $to_sort = $uppercase_strings;
                    sort($to_sort);
                    return $to_sort;
                }, $el3);

                usort($new_el3, function($a, $b) {
                    return $a <=> $b;
                });

                return $new_el3;
            }, $el4);

            usort($new_el4, function($a, $b) {
                return $a <=> $b;
            });
            return $new_el4;
        }, $el5);
    }, $original_arr);

    display_array($original_arr, "Original array");
    echo "<br style='margin-top: 10px; margin-bottom: 10px;'>";
    display_array($sorted_arr, "Sorted array");
    ?>
</body>

</html>