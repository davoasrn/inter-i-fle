  <!--right panel start-->
        <div class="right_panel">
        	<div class="loginbox">
				<?php echo $this->Form->create('User',array('url'=>'login/'));?>
            	<span>LOGIN</span>
                <p class="input_boxes"><?php echo $this->Html->image('code_icon.png');?><?php echo $this->Form->input('StudioName',array('label'=>false,'div'=>false,'onblur' =>"if(this.value=='')this.value='Codice Studio';","onfocus" => "if(this.value=='Codice Studio')this.value='';" ,"value" => @$CodiceStudio)); ?> </p>
                <p class="input_boxes"><?php echo $this->Html->image('username.png');?><?php echo $this->Form->input('username',array('label'=>false,'div'=>false,'onblur' =>"if(this.value=='')this.value='Username';","onfocus" => "if(this.value=='Username')this.value='';" ,"value" => @$username)); ?></p>
                <p class="input_boxes"><?php echo $this->Html->image('password.png');?><?php echo $this->Form->input('password',array('label'=>false,'div'=>false,'onblur' =>"if(this.value==''){this.value='Password';}else{this.type='password';}","onfocus" => "if(this.value=='Password'){this.value='';}else{this.type='password';}" ,"value" => "Password",'onchange'=>"this.type='password';",'onclick'=>"this.type='password';")); ?></p>
		<span> <?php echo $this->Form->submit('LOGIN',array('id'=>'submit','class'=>'login_btn btn','div'=>false)); ?></span>
               <?php echo $this->Form->end(); ?>

 
                               <p id="nav">
					<a href="#" class="forget" title="">Ho perso la mia password</a>
				</p>
			<div id="login">
					
					<?php  
						echo $this->Form->create('USER',array('url'=>'forgotPassword','autocomplete'=>'off'));	?>
						<span class="forgot_input_boxes"> 
<?php echo $this->Form->input('email',array('label'=>false,'div'=>false,'onblur' =>"if(this.value=='')this.value='E-mail';","onfocus" => "if(this.value=='E-mail')this.value='';" ,"value" => 'E-mail'));?> </span>
						<span><?php echo $this->Form->submit('Invia le credenziali',array('class'=>'btn','div'=>false)); ?></span>
					
					<?php echo $form->end();?>  
			</div>


          
            </div>
            <div class="googleadd"><div class="heading">Pubblicità Google</div>
            </div>
        </div>
        <!--right panel end-->

		<!--left panel start-->
		<div class="left_panel">
        	<div class="top_text">PORTALE DEDICATO ALLE SOCIETA' DI SERVIZI E STUDI PROFESSIONALI PER LA GESTIONE DEI PROPRI CLIENTI, USUFRUIRE DI NOTIZIARI PER LA CLIENTELA, MODULISTICA A COMPILAZIONE AUTOMATICA, STRUMENTI DI CALCOLO, GESTIONE DEI DOCUMENTI, MESSAGGISTICA E CHAT INTERNA, SPAZIO WEB E AGENDA DELLE ATTIVITA'.</div>
            <div class="mid_text">
				<p><span>Ogni professionista percepisce</span> i profondi cambiamenti in atto: nell’economia; nei rapporti con la clientela; nel mercato.
Prevenire gli eventi, anticipare le esigenze del cliente, innovare il modo di lavorare dotandosi di strumenti e servizi innovativi, può significare mantenere e migliorare la redditività della professione.</p>
            		<p><span>Continuare con i vecchi (o in assenza di)</span> metodi organizzativi, può significare, nel breve periodo, la perdita di consistenti quote di mercato. E' oramai convinzione comune che l'attività professionale come svolta finora, a breve, non sarà più concepibile. . </p>
				<p>Le parole d'ordine sono ORGANIZZAZIONE e AGGREGAZIONE.</p>
				<p><span>Uno studio organizzato</span> acquista valore può quindi essere conferito, ceduto, fuso, trasferito a terzi o alle nuove generazioni.
In uno studio organizzato, la maggior parte delle prestazioni può essere svolta dai collaboratori attraverso processi o procedure collaudate.</p>
			<p><span>Uno studio organizzato</span> mette a disposizione dei propri collaboratori idonei strumenti e un ambiente che facilita il lavoro. Uno studio organizzato può facilmente essere aggregato ad altro studio.</p>
            <p><span>Organizzare uno studio</span> professionale, è tuttavia una attività che richiede tempo, costi e che non si esaurisce in un certo periodo ma necessita di una dedizione continua.</p>
				<p><span>In questo contesto,</span> si colloca INTERFILE NETWORK un progetto che consente di affrontare le sfide del mercato fornendo soluzioni e strumenti innovativi.</p>
                <p><span>Attraverso sistemi informatici evoluti,</span> tutti on-line, offriamo gran parte dell'organizzazione, degli strumenti di controllo e degli strumenti di lavoro necessari per affrontare le sfide del prossimo futuro e dare una svolta alla Vostra attività. Il tutto in rete, attraverso la rete.</p>
                <p><span>Immaginatevi seduti </span>alla scrivania del Vs. ufficio o in qualsiasi altra parte del pianeta, collegati a una pagina web che vi consente di:
Avere sotto controllo le attività di studio, gli impegni e gli appuntamenti Vs. e de</p>
			<p>Comunicare in vari modi coi colleghi, coi collaboratori</p>
            <P><span>In rete…… GRATIS… a ottobre 2012.</span>
			<ul class='customul'><li>Se Vuoi provarlo gratuitamente;</li>
            <li>Se Vuoi stupire collaboratori e clienti fidelizzandoli con qualcosa di utile e innovativo.</li></ul>
            </P>
            <p>Iscriviti ora al sito interfile.it http://www.interfile.it/web/subscribe e sarai così aggiornato in tempo reale e potrai essere fra i primi a provare INTERFILE NETWORK (l'iscrizione è gratuita e non implica alcun impegno).	</p>
            </div>
        </div>
    
      <!--left panel end-->
     
      
	

