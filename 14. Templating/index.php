<?php
function renderPage($page)
{
   $title = '';
   $content = '';

   switch ($page) {
      case 'home':
         $title = 'Beranda';
         ob_start();
         require_once('pages/home.php');
         $content = ob_get_clean();
         break;
      case 'about':
         $title = 'Tentang Kami';
         ob_start();
         require_once('pages/about.php');
         $content = ob_get_clean();
         break;
      case 'contact':
         $title = 'Kontak';
         ob_start();
         require_once('pages/contact.php');
         $content = ob_get_clean();
         break;
      default:
         $title = 'Halaman Tidak Ditemukan';
         ob_start();
         require_once('pages/not_found.php');
         $content = ob_get_clean();
         break;
   }

   return ['title' => $title, 'content' => $content];
}

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$pageData = renderPage($page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $pageData['title'] ?></title>
</head>

<body>
   <header>
      <h1>Selamat Datang</h1>
   </header>
   <nav>
      <ul>
         <li><a href="index.php?page=home">Beranda</a></li>
         <li><a href="index.php?page=about">Tentang Kami</a></li>
         <li><a href="index.php?page=contact">Kontak</a></li>
      </ul>
   </nav>
   <main>
      <?= $pageData['content'] ?>
   </main>
   <footer>
      <p>&copy; <?= date('Y') ?> Footer</p>
   </footer>
</body>

</html>