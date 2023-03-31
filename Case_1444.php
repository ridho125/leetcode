<!DOCTYPE html>
<html>
<body>

<?php
    function ways($pizza, $k) {
        $rows = count($pizza); $cols = count(str_split($pizza[0]));
        $apples = array(); $dp = array();
		// $apples[$rows + 1][$cols + 1];
        // $dp[$k][$rows][$cols];
        for ($row = $rows - 1; $row >= 0; $row--) {
            for ($col = $cols - 1; $col >= 0; $col--) {
				print_r($row); print_r($col);
                $apples[$row][$col] = 
				($pizza[$row][$col] == 'A' ? 1 : 0) + 
				$apples[$row + 1][$col] + 
				$apples[$row][$col + 1] - 
				$apples[$row + 1][$col + 1];
                $dp[0][$row][$col] = $apples[$row][$col] > 0 ? 1 : 0;
            }
        }
        $mod = 1000000007;
        for ($remain = 1; $remain < $k; $remain++) {
            for ($row = 0; $row < $rows; $row++) {
                for ($col = 0; $col < $cols; $col++) {
                    for ($next_row = $row + 1; $next_row < $rows; $next_row++) {
                        if ($apples[$row][$col] - $apples[$next_row][$col] > 0) {
                            $dp[$remain][$row][$col] += $dp[$remain - 1][$next_row][$col];
                            $dp[$remain][$row][$col] %= $mod;
                        }
                    }
                    for ($next_col = $col + 1; $next_col < $cols; $next_col++) {
                        if ($apples[$row][$col] - $apples[$row][$next_col] > 0) {
                            $dp[$remain][$row][$col] += $dp[$remain - 1][$row][$next_col];
                            $dp[$remain][$row][$col] %= $mod;
                        }
                    }
                }
            }
        }
        return $dp[$k - 1][0][0];
        
    }
echo ways(["A..","AAA","..."],3);
// echo ways(["A..","AA.","..."],3);
// echo ways(["A..","A..","..."],1);
?> 

</body>
</html>