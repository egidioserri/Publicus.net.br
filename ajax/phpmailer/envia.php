<?php  


		
		$nome     = utf8_decode (strip_tags(trim($_POST['nomeremetente'])));
		$email    = utf8_decode (strip_tags(trim($_POST['emailremetente'])));
		$telefone = utf8_decode (strip_tags(trim($_POST['telefone'])));
		$senha = utf8_decode (strip_tags(trim($_POST['senha'])));
		$estabelecimento = utf8_decode (strip_tags(trim($_POST['estabelecimento'])));
		$cnpj = utf8_decode (strip_tags(trim($_POST['cnpj'])));
		$endereco = utf8_decode (strip_tags(trim($_POST['endereco'])));
		$cep = utf8_decode (strip_tags(trim($_POST['cep'])));

		

			
			require_once('PHPMailer/class.phpmailer.php');
			
			$Email = new PHPMailer();
			$Email->SetLanguage("br");
			$Email->IsSMTP(); // Habilita o SMTP 
			$Email->SMTPAuth = true; //Ativa e-mail autenticado
			$Email->Host = 'mail.publicus.net.br'; // Servidor de envio # verificar qual o host correto com a hospedagem as vezes fica como smtp.
			$Email->Port = '465'; // Porta de envio
			$Email->SMTPSecure = 'ssl';
			$Email->Username = 'egidioserri@publicus.net.br'; //e-mail que será autenticado
			$Email->Password = 'Hesoyam@2020'; // senha do email
			// ativa o envio de e-mails em HTML, se false, desativa.
			$Email->IsHTML(true); 
			// email do remetente da mensagem
			$Email->From = 'egidioserri@publicus.net.br';
			// nome do remetente do email
			$Email->FromName = utf8_decode($email);
			// Endereço de destino do emaail, ou seja, pra onde você quer que a mensagem do formulário vá?
			$Email->AddReplyTo($email, $nome);
			$Email->AddAddress("egidioserri@publicus.net.br"); // para quem será enviada a mensagem
			// informando no email, o assunto da mensagem
			$Email->Subject = "Credenciamento Amigo Entregas";
			// Define o texto da mensagem (aceita HTML)
			$Email->Body .= "<br /><br />
							 <strong>Nome:</strong> $nome<br /><br />
							 <strong>E-mail:</strong> $email<br /><br />
							 <strong>Telefone:</strong> $telefone<br /><br />
							 <strong>Senha:</strong> $senha<br /><br />
							 <strong>Estabelecimento:</strong> $estabelecimento<br /><br />
							 <strong>Cnpj:</strong> $cnpj<br /><br />
							 <strong>Endereço:</strong> $endereço<br /><br />
							 <strong>CEP:</strong> $cep<br /><br />


			// verifica se está tudo ok com oa parametros acima, se nao, avisa do erro. Se sim, envia.
			if(!$Email->Send()){
				echo "<p>A mensagem não foi enviada. </p>";
				echo "Erro: " . $Email->ErrorInfo;
			}else{
				echo "<script>location.href='sucesso.html'</script>";
		
			}
			
?>
