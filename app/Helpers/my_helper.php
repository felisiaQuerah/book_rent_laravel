<?php

if (!function_exists('get_my_app_config')) {
    function get_my_app_config($key)
    {
        $config =  [
            'logo'             => 'img/logo.png',
            'favicon'          => 'img/logo_only.png',
            'hero_bg'          => asset('img/bg/bg3.jpeg'),
            'nama_web'   => 'Book Rent',
            'email'            => '',
            'telpon'           => '',
            'phone'            => '',
            'alamat'           => '',
            'link_facebook'    => '#',
            'link_twitter'     => '#',
            'link_instagram'   => '#',
            'link_youtube'     => '#',
        ];

        return $config[$key];
    }
}

if (!function_exists('daysToYearMonthDay')) {
    function daysToYearMonthDay($days)
    {
        $years  = floor($days / 365);
        $days -= 365 * $years;
        $months = floor($days / 30);
        $days -= 30 * $months;
        $days   = $days % 30;

        $result = '';

        if ($years > 0) {
            $result .= $years . ' tahun';
        }

        if ($months > 0) {
            if ($result != '') {
                $result .= ' - ';
            }
            $result .= $months . ' bulan';
        }

        if ($days > 0) {
            if ($result != '') {
                $result .= ' - ';
            }
            $result .= $days . ' hari';
        }

        return $result;
    }
}

if (!function_exists('daysToYearMonthDayForForm')) {
    function daysToYearMonthDayForForm($days)
    {
        $years  = floor($days / 365);
        $days -= 365 * $years;
        $months = floor($days / 30);
        $days -= 30 * $months;
        $days   = $days % 30;

        return [
            'year'  => $years,
            'month' => $months,
            'day'   => $days,
        ];
    }
}

if (!function_exists('getIndonesiaMonth')) {
    function getIndonesiaMonth($month)
    {
        $monthText = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        return $monthText[(int)$month - 1];
    }
}

if (!function_exists('stockStatus')) {
    function stockStatus($stock,$limit)
    {
        //0 Out of Stock
        // <= $limit = Limited
        // > $limit = Available
        if($stock == 0){
            return '<span class="badge bg-danger">Out of Stock</span>';
        }elseif($stock <= $limit){
            return '<span class="badge bg-warning">Limited</span>';
        }else{
            return '<span class="badge bg-success">Available</span>';
        }
    }
}
//stock warna
if(!function_exists('stockColor')){
    function stockColor($stock,$limit){
        //0 Out of Stock
        // <= $limit = Limited
        // > $limit = Available
        if($stock == 0){
            return '<span class="badge bg-danger">'.$stock.'</span>';
        }elseif($stock <= $limit){
            return '<span class="badge bg-warning">'.$stock.'</span>';
        }else{
            return '<span class="badge bg-success">'.$stock.'</span>';
        }
    }
}

if(!function_exists(('monthIndo'))){
    function monthIndo($month){
        $monthText = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        return $monthText[(int)$month - 1];
    }
}
if(!function_exists(('getDistance'))){
    function getDistance($lat1, $lon1, $lat2, $lon2, $unit='K') {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
          return 0;
        }
        else {
          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $unit = strtoupper($unit);

          if ($unit == "K") {
            return ($miles * 1.609344);
          } else if ($unit == "N") {
            return ($miles * 0.8684);
          } else {
            return $miles;
          }
        }
      }
}

//calculate_similarity
if(!function_exists('calculate_similarity')){
    // Fungsi untuk menghitung kesamaan antara dua vektor fitur menggunakan cosine similarity
    function calculate_similarity($vector1, $vector2) {
        // Memastikan kedua vektor memiliki panjang yang sama
        if (count($vector1) !== count($vector2)) {
            return 0; // Mengembalikan similarity 0 jika panjang vektor tidak sama
        }

        // Menghitung jumlah produk yang di-klik atau dicari oleh kedua pengguna
        $dot_product = 0;
        $norm_vector1 = 0;
        $norm_vector2 = 0;

        // Hitung dot product (jumlah perkalian setiap elemen)
        $num_features = count($vector1);
        dd($vector1);
        for ($i = 0; $i < $num_features; $i++) {
            $value1 = $vector1[$i];
            $value2 = $vector2[$i];
            $dot_product += $value1 * $value2;

            // Hitung norm untuk vektor 1
            $norm_vector1 += pow($value1, 2);
        }

        // Hitung norm untuk vektor 2
        foreach ($vector2 as $value2) {
            $norm_vector2 += pow($value2, 2);
        }

        // Hitung panjang vektor dengan akar kuadrat dari jumlah kuadrat
        $norm_vector1 = sqrt($norm_vector1);
        $norm_vector2 = sqrt($norm_vector2);

        // Jika kedua vektor adalah vektor nol, maka similarity adalah 0
        if ($norm_vector1 == 0 || $norm_vector2 == 0) {
            return 0;
        }

        // Hitung cosine similarity
        $cosine_similarity = $dot_product / ($norm_vector1 * $norm_vector2);

        return $cosine_similarity;
    }


}

if(!function_exists('html_limit')){
    function html_limit($value, $limit = 100, $end = '...') {
        if (strlen(strip_tags($value)) <= $limit) return $value;

        $output = '';
        $in_tag = false;
        $tag_buffer = '';
        $stripped_length = 0;

        for ($i = 0; $i < strlen($value); $i++) {
            $char = $value[$i];
            $output .= $char;

            if ($char == '<') {
                $in_tag = true;
                $tag_buffer = '';
            }

            if ($in_tag) {
                $tag_buffer .= $char;
            }

            if ($char == '>') {
                $in_tag = false;
                if (strip_tags($tag_buffer) == $tag_buffer) {
                    $stripped_length += strlen(strip_tags($tag_buffer));
                }
            }

            if (!$in_tag) {
                $stripped_length++;
                if ($stripped_length >= $limit) break;
            }
        }

        return $output . $end;
    }

}

