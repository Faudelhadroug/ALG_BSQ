<?php

function find($string)
{
  $y = intval($string);
  $x = strlen(substr($string, strlen($y))) / $y;
  $data = trim(substr($string, strlen($y)));
  $array = explode("\n", $data);
  $add = 2;
  $result = ['positionX' => 0, 'positionY' => 0, 'axe' => 0];
  for($key = 0; $key < $y; $key++)
  {
    for($i = 0; $i < $x - 1; $i++)
    {
      for($l = 0; $l < $add; $l++)
      {
        if(array_key_exists($key, $array) && array_key_exists($key + $l, $array) && $i + $l < $x - 2 && $array[$key][$i] === '.' && $array[$key + $l][$i + $l] === '.')
        {
          for($m = 0; $m < $l + 1; $m++)
          {
            if($array[$key+$m][$i] === '.' && $array[$key][$i+$m] === '.' && $array[$key+$l][$i+$m] === '.' && $array[$key+$m][$i+$l] === '.')
            {
              if($m === $l &&  $m > $result['axe'])
              {
                $result = ['positionX' => $i, 'positionY' => $key, 'axe' => $m];
                $add++;
              }
            }
            else
            {
              $l = $add;
              break;
            }
          }
        }
        else
        {
          break;
        }
      }
    }
  }
  for($a = 0; $a < $result['axe'] + 1; $a++)
  {
    for($b = 0; $b < $a + 1; $b++)
    {
      $array[$result['positionY']+$b][$result['positionX']] = 'X';
      $array[$result['positionY']][$result['positionX']+$b] = 'X';
      $array[$result['positionY']+$a][$result['positionX']+$b] = 'X';
      $array[$result['positionY']+$b][$result['positionX']+$a] = 'X';
    }
  }
  $data = implode($array, "\n");
  echo($data);
  return;
}
find(file_get_contents($argv[1]));