<?php
if($_POST){
	
	if(empty($_POST['nome']) || empty($_POST['email'])){
		echo '<script>
			$(document).ready(function(){
				swal("Ops...","Preencha todos os campos obrigatórios!","warning");
			});
			</script>';
	}else{
		$nome 		= utf8_decode($_POST['nome']);
		$email 		= utf8_decode($_POST['email']);
		$mensagem 		= utf8_decode($_POST['mensagem']);
		$assunto 	= 'Contato enviado pelo site';
		
		
		require_once('phpmailer/PHPMailer/class.phpmailer.php');

		$Email = new PHPMailer();
		$Email->SetLanguage("br");
		$Email->IsSMTP(); // Habilita o SMTP 
		$Email->SMTPAuth = true; //Ativa e-mail autenticado
		$Email->Host = 'publicus.net.br'; //Servidor de envio # verificar qual o host correto com a hospedagem as vezes fica como smtp.
		$Email->Port = '465'; // Porta de envio
		$Email->SMTPSecure = 'ssl';
		$Email->Username = 'egidioserri@publicus.net.br'; //e-mail que será autenticado
		$Email->Password = 'Hesoyam@2020'; // senha do email
		// ativa o envio de e-mails em HTML, se false, desativa.
		$Email->IsHTML(true); 
		// email do remetente da mensagem
		$Email->From = $email;
		//$Email->SMTPDebug = 2; //mostra erros mais detalhados caso houver
		// nome do remetente do email
		$Email->FromName = ($nome);
		// Endereço de destino do emaail, ou seja, pra onde você quer que a mensagem do formulário vá?
		$Email->AddReplyTo($email, $nome);
		$Email->AddAddress("egidioserri@publicus.net.br"); //  para quem será enviada a mensagem
		//$Email->AddCC('email@hotmail.com', 'Nome da pessoa'); // Copia
		//$Email->AddBCC('email@hotmail.com.br', 'Nome da pessoa'); // Cópia Oculta
		// informando no email, o assunto da mensagem
		$Email->Subject = utf8_decode($assunto);
		// Define o texto da mensagem (aceita HTML)
		$Email->Body .= "<br />
						 <strong>Nome:</strong> $nome<br />									
						 <strong>E-mail:</strong> $email<br />
						 <strong>Mensagem:</strong> $mensagem<br />
						 ";	
		// verifica se está tudo ok com oa parametros acima, se nao, avisa do erro. Se sim, envia.
		if(!$Email->Send()){				
			 echo'
			<script>
				$(document).ready(function(){
					swal("Ops '.utf8_encode($nome).'...","Verifique os dados! !", "error");
				});
			</script>';

		}else{
			 echo'
		<script>
			$(document).ready(function(){
				swal("Sucesso '.utf8_encode($nome).'...", "Sua mensagem foi enviada. \n Obrigado!", "success")
			});
		</script>';
		

		}		
	}
}
