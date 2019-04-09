
var Site = {
	start: function(){
		if($('file_upload')) Site.changeInput();		
	},
	
	changeInput: function(){
		var input = $('file_upload').getElement('input[type=file]');	
		//var upload_btn = $('file_upload').getElement('input[type=submit]').remove();
		var container = new Element('span',{
			'class':'input_file_wrapper'
		});
		var fake_text = new Element('input',{
			'type':'text',
			'class':'fake-text',
			'value':''
		});
		input.set({
			styles:{
				'opacity':0.0001,
				'width':483,
				'height':32,
				'margin':0,
				'padding':0,
				'font-size':24,
				'cursor': 'pointer',
				'border':'none',
				'z-index':10000
			}		  
		})
		container.injectBefore(input).adopt([input,fake_text]);
		input.addEvents({
			'change':function(){
				fake_text.set({
					'value':input.get('value')
				});
				$('explain').set({
					'text':'... file is uploading. Please be pacient.'
				});
				$('file_upload').submit();
			}			
		})		
	}
}
window.addEvent('domready', Site.start);

var Site1 = {
	start1: function(){
		if($('file_upload1')) Site1.changeInput();		
	},
	
	changeInput: function(){
		var input = $('file_upload1').getElement('input[type=file]');	
		//var upload_btn = $('file_upload1').getElement('input[type=submit]').remove();
		var container = new Element('span',{
			'class':'input_file_wrapper'
		});
		var fake_text = new Element('input',{
			'type':'text',
			'class':'fake-text',
			'value':''
		});
		input.set({
			styles:{
				'opacity':0.0001,
				'width':483,
				'height':32,
				'margin':0,
				'padding':0,
				'font-size':24,
				'cursor': 'pointer',
				'border':'none',
				'z-index':10000
			}		  
		})
		container.injectBefore(input).adopt([input,fake_text]);
		input.addEvents({
			'change':function(){
				fake_text.set({
					'value':input.get('value')
				});
				$('explain').set({
					'text':'... file is uploading. Please be pacient.'
				});
				$('file_upload1').submit();
			}			
		})		
	}
}
window.addEvent('domready', Site1.start1);




var Site2 = {
	start2: function(){
		if($('file_upload2')) Site2.changeInput();		
	},
	
	changeInput: function(){
		var input = $('file_upload2').getElement('input[type=file]');	
		//var upload_btn = $('file_upload2').getElement('input[type=submit]').remove();
		var container = new Element('span',{
			'class':'input_file_wrapper'
		});
		var fake_text = new Element('input',{
			'type':'text',
			'class':'fake-text',
			'value':''
		});
		input.set({
			styles:{
				'opacity':0.0001,
				'width':483,
				'height':32,
				'margin':0,
				'padding':0,
				'font-size':24,
				'cursor': 'pointer',
				'border':'none',
				'z-index':10000
			}		  
		})
		container.injectBefore(input).adopt([input,fake_text]);
		input.addEvents({
			'change':function(){
				fake_text.set({
					'value':input.get('value')
				});
				$('explain').set({
					'text':'... file is uploading. Please be pacient.'
				});
				$('file_upload2').submit();
			}			
		})		
	}
}
window.addEvent('domready', Site2.start2);

var Site3 = {
	start3: function(){
		if($('file_upload3')) Site3.changeInput();		
	},
	
	changeInput: function(){
		var input = $('file_upload3').getElement('input[type=file]');	
		//var upload_btn = $('file_upload3').getElement('input[type=submit]').remove();
		var container = new Element('span',{
			'class':'input_file_wrapper'
		});
		var fake_text = new Element('input',{
			'type':'text',
			'class':'fake-text',
			'value':''
		});
		input.set({
			styles:{
				'opacity':0.0001,
				'width':483,
				'height':32,
				'margin':0,
				'padding':0,
				'font-size':24,
				'cursor': 'pointer',
				'border':'none',
				'z-index':10000
			}		  
		})
		container.injectBefore(input).adopt([input,fake_text]);
		input.addEvents({
			'change':function(){
				fake_text.set({
					'value':input.get('value')
				});
				$('explain').set({
					'text':'... file is uploading. Please be pacient.'
				});
				$('file_upload3').submit();
			}			
		})		
	}
}
window.addEvent('domready', Site3.start3);