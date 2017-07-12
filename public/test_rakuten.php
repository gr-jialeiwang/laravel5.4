<?php

$A = 3;
$B = 4;
$N = 100;

$result = solution($A, $B, $N);
var_dump($result);

function solution($A, $B, $N)
{
    $f0 = $A % 1000000007;
    $f1 = $B % 1000000007;
    
    if ($N == 0) {
        return $f0;
    } else if ($N == 1) {
        return $f1;
    }
    
    $F = [[1,1],[1,0]];
    power($F, $N - 1);

    $res = getMatrixMul([[$f1, $f0],[0, 0]], $F);
    
    return $res[0][0] % 1000000007;
}

function getMatrixMul($a, $b)
{
    $a11 = $a[0][0] * $b[0][0] + $a[0][1] * $b[1][0];
    $a12 = $a[0][0] * $b[0][1] + $a[0][1] * $b[1][1];
    $a21 = $a[1][0] * $b[0][0] + $a[1][1] * $b[1][0];
    $a22 = $a[1][0] * $b[0][1] + $a[1][1] * $b[1][1];
    $r = [[$a11, $a12], [$a21, $a22]];
    return $r;
}

function power(&$F, $n)
{
    $M = [[1,1],[1,0]];
    
    if($n == 0 || $n == 1) {
        return $M;
    }
  
    power($F, intval($n/2));
    multiply($F, $F);

    if($n%2 != 0) {
        multiply($F, $M);
    }
}

function multiply(&$F, $M)
{
    $x =  $F[0][0]*$M[0][0] + $F[0][1]*$M[1][0];
    $y =  $F[0][0]*$M[0][1] + $F[0][1]*$M[1][1];
    $z =  $F[1][0]*$M[0][0] + $F[1][1]*$M[1][0];
    $w =  $F[1][0]*$M[0][1] + $F[1][1]*$M[1][1];

    $F[0][0] = $x % 1000000007;
    $F[0][1] = $y % 1000000007;
    $F[1][0] = $z % 1000000007;
    $F[1][1] = $w % 1000000007;
}
