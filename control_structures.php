<html>
    <head>
        <title>Control Structures</title>
    </head>
    <body>
        <h1>Control Structures</h1>
        <?php
          //if else elseif 
          $score = 95;
          if($score >= 90){
              echo("A");
              if($score >=95){
                  echo("+");
              }
          } else if($score >= 80) {
              echo("B");
              if($score>=85){
                  echo("+");
              }
          } else {
              echo("C");
          }
        ?>
        <?php //alternative syntax ?>
        <?php $score = 90 ?>
        <?php echo "<br>";?>
        <?php if($score >= 90): ?>
            <b>A</b>
        <?php elseif($score >=85): ?>
            <b>B</b>
        <?php else: ?>
            <b>F</b>
        <?php endif ?>
        <h2>Loops</h2>
        <?php
            //while
            $i = 0;
            while($i <= 15){
                echo $i;
                $i++;
            }
            //do while
            $j = 0;
            do {
                echo $i;
                $i++;
            }while($i <= 15);
            // for 
            for($i = 0; $i < 15 ; $i++){
                echo $i++;
            }
            //break
            $p = 0;
            do{
                echo $p++;
                break;
            }while($p <= 15);
            //continue
            $s = 0;
            while($s <= 15){
                if($s % 2 ===0){
                    $s++;
                    continue;
                }
                echo($s++);
            }
            //foreach
            echo "<br>";
            $pl = ['php','C','Python'];
            foreach($pl as $lang){
                echo($lang."<br>");
            }
            //associative array(also use json_encode, implode)
            $person = [
                'name' => 'Preethi',
                'email' => 'pree@gmail.com',
                'skills' => ['PHP','HTML','CSS'],
            ];
            foreach($person as $key => $value){
                echo $key.':';
                if(is_array($value)){
                    foreach($value as $skills) {
                        echo $skills.'-';
                    }
                } else {
                    echo $value;
                }
                echo '<br>';
            }
        ?>
        <h2>Switch</h2>
        <?php
            $payment = 'declined';
            switch($payment) {
                case 'paid':
                    echo "Payment paid";
                    break;
                case 'declined':
                    echo "Not paid";
                    break;
                default:
                    echo "Pending";
            }
        ?>
        <h2>Match expression </h2>
        <p>Introduced in php 8.0</p>
        <?php
            /*$payment = 1;
            $paymentStatus = match($payment){
                1 => 'Paid',
                2,3 => 'Pending',
                0 => 'Not Paid',
                default: 'Status unknown',
            }*/
        ?>
    </body>
</html>