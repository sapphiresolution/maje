<?php

$context_for_fopen = stream_context_create([
  'ssl' => [
    'verify_peer' => false,
    'cafile' => '/etc/ssl/certs/cacert.pem',
  ]
]);


function load_products($spreadsheet_url = '', $out_file = '_products.php') {
  global $PRODUCTS;

  $context_for_fopen = stream_context_create([
    'ssl' => [
      'verify_peer' => false,
      'cafile' => '/etc/ssl/certs/cacert.pem',
    ]
  ]);

  $spreadsheet_data = [];

  if( ! (file_exists( $out_file ) || empty( $spreadsheet_url )) ):
    $columns = [];

    if (($handle = fopen($spreadsheet_url, "r", false, $context_for_fopen)) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if(empty($columns))
          $columns = array_flip( array_map('trim', $data) );
        else
          $spreadsheet_data[] = $data;
      }
      fclose($handle);

      $prices = [];
      foreach ($columns as $name => $index) {
        $arr = explode('-', $name, 2);

        if( 2 != count($arr) )
          continue;

        list($left, $right) = $arr;
        if('PRICE' === $left) {
          $prices[ $right ] = $index;
        }
      }

      $output = "<?php\n\n";
      foreach ($spreadsheet_data as $product) {
        $product = array_map('trim', $product);

        if( empty($product[ $columns['ID'] ]) )
          continue;

        $output .= '$PRODUCTS["' . $product[ $columns['ID'] ] . '"] = [' . "\n" ;
        $output .= '  "ID" => "' . $product[ $columns['ID'] ] . '"' . ",\n" ;
        // $output .= '  "_ID" => "' . $product[ $columns['_ID'] ] . '"' . ",\n" ;

        if(isset($columns['URL']))
          $output .= '  "URL" => "' . ($product[ $columns['URL'] ] ?: '') . '"' . ",\n" ;
        else
          $output .= '  "URL" => word("URL_' . $product[ $columns['ID'] ] . '", false)' . ",\n" ;

        $output .= '  "NAME" => "' . $product[ $columns['NAME'] ] . '"'  . ",\n" ;

        if(isset($columns['LOOKS']))
          $output .= '  "LOOKS" => "' . $product[ $columns['LOOKS'] ] . '"'  . ",\n" ;

        if(isset($columns['ORDER']))
          $output .= '  "ORDER" => ' . ($product[ $columns['ORDER'] ] ?: 0) . ",\n" ;
        else
          $output .= '  "ORDER" => 0' . ",\n" ;

        $output .= '  "PRICE" => [' . "\n";
        foreach ($prices as $lang => $index) {
          $price = $product[ $index ] ?: 0;
          $price = str_replace([',', ' '], ['.', ''], $price);

          $output .= '    "' . $lang . '" => ' . $price . ',' . "\n";
        }
        $output .= "  ],\n";
        $output .= "];\n";
      }

      file_put_contents($out_file, $output);
    } else
      die("Problem reading csv");
  endif;

  if(file_exists( $out_file ))
    include $out_file;
}

function load_words($prefix, $spreadsheet_url = '', $out_file = '_urls.php') {
  global $words;
  global $context_for_fopen;

  $spreadsheet_data = [];

  if( ! (file_exists( $out_file ) || empty( $spreadsheet_url )) ):
    $columns = [];

    if (($handle = fopen($spreadsheet_url, "r", false, $context_for_fopen)) !== FALSE) {
      while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
        if(empty($columns))
          $columns = array_flip( array_map('trim', $data) );
        else
          $spreadsheet_data[] = $data;
      }
      fclose($handle);

      $output = "<?php\n\n";
      foreach ($spreadsheet_data as $row) {
        $row = array_map('trim', $row);

        $output .= '$words["' . $prefix . '_' . $row[ $columns['ID'] ] . '"] = [' . "\n" ;
        foreach ($columns as $lang => $id_column) {
          if('ID' === $lang)  continue;
          if('URL' === $lang) $lang = 'ALL';

          try {
            $output .=  ' "' . $lang . '" => "' . clean_cell_data( $row[ $id_column ] ) . '"' . ",\n";
          } catch (Exception $e) {
            error_log( print_r([$lang, $row], true) );
            throw $e;

          }
        }
        $output .= "];\n";
      }

      file_put_contents($out_file, $output);
    } else
      die("Problem reading csv");
  endif;

  if(file_exists( $out_file ))
    include $out_file;
}

function clean_cell_data($data) {
  $data = str_replace('"', '\\"', $data);
  $data = str_replace('$', '\$', $data);
  return $data;
}
