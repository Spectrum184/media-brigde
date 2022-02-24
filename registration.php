<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho+B1:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="icon" href="./images/favicon.png" />
  <title>ネットワーキング統合サービス登録 | MEDIA BRIDGE</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/styles.css" />
  <meta name="keywords" content="keywords" content="ネットワーキング統合サービス | MEDIA BRIDGE" />
  <meta name="description" content="ネットワーキング統合サービス | MEDIA BRIDGE" />
  <meta name="author" content="ネットワーキング統合サービス | MEDIA BRIDGE" />

  <meta itemprop="name" content="ネットワーキング統合サービス | MEDIA BRIDGE" />
  <meta itemprop="description" content="ネットワーキング統合サービス | MEDIA BRIDGE" />
  <meta itemprop="image" content="" />
  <meta property="og:locale" content="jp" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="ネットワーキング統合サービス | MEDIA BRIDGE" />
  <meta property="og:description" content="ネットワーキング統合サービス | MEDIA BRIDGE" />
  <meta property="og:site_name" content="ネットワーキング統合サービス | MEDIA BRIDGE" />
  <!--[if lt IE 7]>
          <html class="no-js lt-ie9 lt-ie8 lt-ie7" prefix="og: http://ogp.me/ns#"><![endif]-->
  <!--[if IE 7]>
          <html class="no-js lt-ie9 lt-ie8" prefix="og: http://ogp.me/ns#"><![endif]-->
  <!--[if IE 8]>
          <html class="no-js lt-ie9" prefix="og: http://ogp.me/ns#"><![endif]-->
  <!--[if gt IE 8]><!-->
</head>

<body>
  <?php
  define("SITEKEY", "6LcjTYseAAAAACwXobowiO9nPXzgN0YFFTUMgK9F");
  define("SECRET_KEY", "6LcjTYseAAAAAIXVXuWuY6UguvGa82dERCLqj1Dr");
  define("MAIL_ADDRESS", "jun@mediabridge.asia");
  define("COMPLETE_URL", "registration-completed.php");

  $arrayError = $arrayData = array("name" => "", "nameKana" => "", "email" => "", "phone" => "", "plan" => "", "content" => "",);
  $isError = false;
  $captchaError = "";

  function showError($error)
  {
    if ($error != "") {
      echo "<small class='text-danger ml-3 text-sm-left'>" . $error . "</small>";
    }
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $arrayError["name"] = "名前をご入力ください";
      $isError = true;
    } else {
      $arrayData["name"] = $_POST["name"];
    }

    if (empty($_POST["email"])) {
      $arrayError["email"] = "メールアドレスをご入力ください";
      $isError = true;
    } else {
      if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $arrayError["email"] = "メールアドレスのフォマードが間違っています。";
        $isError = true;
      } else {
        $arrayData["email"] = $_POST["email"];
      }
    }

    if (empty($_POST["phone"])) {
      $arrayError["phone"] = "電話番号をご入力ください";
      $isError = true;
    } else {
      $pattern = "/^(0([1-9]{1}-?[1-9]\d{3}|[1-9]{2}-?\d{3}|[1-9]{2}\d{1}-?\d{2}|[1-9]{2}\d{2}-?\d{1})-?\d{4}|0[789]0-?\d{4}-?\d{4}|050-?\d{4}-?\d{4})$/";

      if (preg_match($pattern, $_POST["phone"]) != 1) {
        $isError = true;
        $arrayError["phone"] = "電話番号のフォマードが間違っています。";
      } else {
        $arrayData["phone"] = $_POST["phone"];
      }
    }

    if (empty($_POST["nameKana"])) {
      $arrayError["nameKana"] = "ふりがなをご入力ください";
      $isError = true;
    } else {
      $arrayData["nameKana"] = $_POST["nameKana"];
    }

    if (empty($_POST["plan"])) {
      $arrayError["plan"] = "プランをご選択ください";
      $isError = true;
    } else {
      $arrayData["plan"] = $_POST["plan"];
    }

    if (empty($_POST["content"])) {
      $arrayError["content"] = "お問合せ内容をご入力ください";
      $isError = true;
    } else {
      $arrayData["content"] = $_POST["content"];
    }

    if (isset($_POST["submit"])) {
      $responseKey = $_POST["g-recaptcha-response"];
      $userIP = $_SERVER["REMOTE_ADDR"];

      $google_url = "https://www.google.com/recaptcha/api/siteverify?secret=" . SECRET_KEY . "&response=$responseKey&remoteip=$userIP";

      $response = file_get_contents($google_url);
      $response = json_decode($response);
      if (!$response->success) {
        $captchaError = "reCAPTCHAが間違っています。";
        $isError = true;
      }
    }
  }

  ?>
  <div class="header-register">
    <a href="./index.html">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
      </svg>
      <span> ホームページ </span>
    </a>
  </div>
  <section class="register section-padding">
    <div class="container">
      <div class="row">
        <div class="section-title col-lg-12">
          <h2>登録申込・お問合せ</h2>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-5">
          <div class="contact-info">
            <div class="contact-info-item">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
              </svg>
              <h3><a href="mailto:jun@mediabridge.asia">jun@mediabridge.asia</a></h3>
              <p>メールでのお問い合わせ・お申込みはこちらから</p>
            </div>
            <div class="contact-info-item">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
              </svg>
              <h3>申込書送付先</h3>
              <p>〒451-0052 名古屋市西区栄生3-2-19 株式会社</p>
            </div>
            <div class="contact-info-item"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
              </svg>
              <h3><a href="tel:0524467711">052-446-7711</a></h3>
              <p>電話でのお問い合わせは 株式会社</p>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-7">
          <div class="contact-form">
            <form method="POST">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <div class="d-flex align-items-center">
                      <span class="text-danger mr-1">*</span><input type="text" name="name" placeholder="名前" value="<?php echo $arrayData["name"] ?>" class="form-control" />
                    </div>
                    <?php showError($arrayError["name"]) ?>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <div class="d-flex align-items-center">
                      <span class="text-danger mr-1">*</span><input type="text" name="nameKana" placeholder="ふりがな" value="<?php echo $arrayData["nameKana"] ?>" class="form-control" />
                    </div>
                    <?php showError($arrayError["nameKana"]) ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <div class="d-flex align-items-center">
                      <span class="text-danger mr-1">*</span><input type="text" name="email" placeholder="Email" value="<?php echo $arrayData["email"] ?>" class="form-control" />
                    </div>
                    <?php showError($arrayError["email"]) ?>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <div class="form-group">
                      <div class="d-flex align-items-center">
                        <span class="text-danger mr-1">*</span> <input type="text" name="phone" placeholder="電話番号" value="<?php echo $arrayData["phone"] ?>" class="form-control" />
                      </div>
                      <?php showError($arrayError["phone"]) ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="plan">
                      <div class="plan-details">
                        <input type="radio" id="plan1" <?php if (isset($_GET['plan']) && $_GET['plan'] == "1") {
                                                          echo "checked";
                                                        } ?> name="plan" value="BIZコネクト WITH FC プランS"> プランS(4,800円/月)

                      </div>
                      <div class="plan-details">
                        <input type="radio" id="plan2" <?php if (isset($_GET['plan']) && $_GET['plan'] == "2") {
                                                          echo "checked";
                                                        } ?> name="plan" value="BIZコネクト WITH FC プランM"> プランM(8,400円/月)
                      </div>
                      <div class="plan-details">
                        <input type="radio" id="plan3" <?php if (isset($_GET['plan']) && $_GET['plan'] == "3") {
                                                          echo "checked";
                                                        } ?> name="plan" value="BIZコネクト WITH FC プランL"> プランL(13,000円/月)
                      </div>
                    </div>
                    <?php showError($arrayError["plan"]) ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="d-flex align-items-center">
                      <span class="text-danger mr-1">*</span> <textarea rows="5" cols="50" name="content" placeholder="お問合せ内容" class="form-control"><?php echo $arrayData["content"] ?></textarea>
                    </div>
                    <?php showError($arrayError["content"]) ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 d-flex align-items-center">
                  <label class="g-recaptcha ml-2" data-sitekey="<?php echo SITEKEY; ?>"></label>
                  <?php showError($captchaError) ?>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-price ml-3">送信</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
  if (isset($_POST["submit"]) && !$isError) {
    $subject = 'ネットワーキング統合サービス登録申込';
    $headers = 'From: webmaster@mediabridge.jp';
    $message = "
    ネットワーキング統合サービスからお問い合わせが届きました.
    -----------------------------------------------------

    名前: {$arrayData['name']} ({$arrayData['nameKana']})
    電話番号: {$arrayData['phone']}
    メールアドレス: {$arrayData['email']}
    プラン: {$arrayData['plan']}
    問い合わせ内容:
    {$arrayData['content']}

    -----------------------------------------------------
    Media Bridge registration form program.";


    mail(MAIL_ADDRESS, $subject, mb_convert_encoding($message, 'ISO-2022-JP', "UTF-8"), $headers);

    echo ("<script>location.href = '" . COMPLETE_URL . "';</script>");
  }
  ?>
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/scrollIt.min.js"></script>
  <script src="js/main.js"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
  </script>
  <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
  </script>
  <script type="text/javascript">
    var onloadCallback = function() {
      console.log("Captcha is ready!");
    };
  </script>
</body>

</html>