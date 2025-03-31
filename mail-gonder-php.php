<?php
// Form gönderildi mi kontrol et
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini al
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? 'DepoGo Web Sitesi İletişim Formu';
    $message = $_POST['message'] ?? '';
    
    // Form verilerini doğrula
    if (empty($name) || empty($email) || empty($message)) {
        header("Location: index.php?status=error");
        exit;
    }
    
    // E-posta alıcısı (kendi e-posta adresiniz)
    $to = "depogosistemleri@gmail.com";
    
    // E-posta başlığı
    $email_subject = "DepoGo İletişim Formu: " . $subject;
    
    // E-posta içeriği
    $email_body = "Yeni bir iletişim formu mesajı aldınız.\n\n";
    $email_body .= "Ad: $name\n";
    $email_body .= "E-posta: $email\n";
    $email_body .= "Konu: $subject\n";
    $email_body .= "Mesaj:\n$message\n";
    
    // E-posta başlıkları
    $headers = "From: $email\n";
    $headers .= "Reply-To: $email\n";
    
    // E-postayı gönder
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Başarılı olursa ana sayfaya yönlendir
        header("Location: index.php?status=success");
    } else {
        // Hata durumunda hata mesajıyla ana sayfaya yönlendir
        header("Location: index.php?status=error");
    }
    
    exit;
}
?>
