function showValidatorsPopup(id,limitX,limitY) {
	element = $(id);
	
	var elementDims = element.getDimensions();
	var viewPort = document.viewport.getDimensions();
	var offsets = document.viewport.getScrollOffsets();
	var centerX = viewPort.width / 2 + offsets.left - elementDims.width / 2;
	var centerY = viewPort.height / 2 + offsets.top - elementDims.height / 2;
	if ( limitX && centerX < limitX )
	{
		centerX = parseInt(limitX);
	}
	if ( limitY && centerY < limitY )
	{
		centerY = parseInt(limitY);
	}
	
	
	element.setStyle( { position: 'absolute', top: Math.floor(centerY) + 'px', left: Math.floor(centerX) + 'px' } ).show();
    $('popup-window-mask').onclick = function(){hideValidatorsPopup(id);}
    $('popup-window-mask').setStyle({
        height: $('html-body').getHeight() + 'px'
    }).show();
    
}


function hideValidatorsPopup(id) {
	$(id).hide();
	$(id).down('.popup-content').update('');
    $('popup-window-mask').hide();
} 

function submitValidatorsPopup(id) {
	if(window.rwvalidators.validate()) {
		window.rwvalidators.serializeCustomOptions();
	    hideValidatorsPopup(id);
	}
}


var CustomOptionValidator = Class.create({
	initialize: function(id, options) {
		this.id = id;
		this.options = options;
	},
	getExtraFieldId: function(extra_field_id,extra_field_data) {
		if(this.options.extra.combined_prefix) {
			return this.id+'-extra-field-'+extra_field_id;
		}
		else {
			return this.id+'-extra-field-'+extra_field_data.prefix;
		}
	},
	getHtml: function(inputType) {
		validForInputType = false;
		for(k=0;k<this.options.for_types.length;k++) {
			if(this.options.for_types[k] == inputType) {
				validForInputType = true;
				break;
			}
		}
		
		if(validForInputType) {
			html = new Element('div',{'class':'validator-container validator-'+this.id});
			html.insert(new Element('input',{'type':'checkbox','name':'custom_validator[]','value':this.id,'id':this.id,'class':'validator-checkbox'}))
			html.insert(new Element('label',{'for':this.id}).update(this.options.title));
			
			if(this.options.extra) {
				for(var extra_id in this.options.extra.elements) {
					if(this.options.extra.elements.hasOwnProperty(extra_id)) {
						label = new Element('label',{'class':'extra-field-label','for' : this.getExtraFieldId(extra_id,this.options.extra.elements[extra_id])}).update(this.options.extra.elements[extra_id].label);
						element = new Element('input',{ 'type':'text',
														'style':this.options.extra.elements[extra_id].style,
														'class':this.getExtraFieldId(extra_id,this.options.extra.elements[extra_id])+' extra-field',
														'id' : this.getExtraFieldId(extra_id,this.options.extra.elements[extra_id])
											});
						html.insert(label);
						html.insert(element);
					}
				}
			}
			
			if(this.options.description) {
				html.insert(new Element('p',{'class':'note'}).update(this.options.description))
			}
			return html;	
		}
		else {
			return '';
		}
	}
});

var CustomOptionValidatorGroup = Class.create({
	initialize: function(group_name) {
		this.group_name = group_name;
		this.validators = new Array();
	},
	
	addValidator: function(validator) {
		this.validators.push(validator);
	},
	getHtmlHeader: function(inputType) {
		return new Element('dt',{'class':'validation-header'}).insert(new Element('a',{'href':'#'}).update(this.group_name));
		return html;
	},
	getHtmlContent: function(inputType) {
		content= new Element('dd');
		validatorCount = 0;
		for(j=0;j<this.validators.length;j++) {
			validatorHtml = this.validators[j].getHtml(inputType);
			if(validatorHtml) {
				validatorCount++;
				content.insert(validatorHtml);
			}
		}
		if(validatorCount) {
			return content;	
		}
		else {
			return '';
		}
	}
	
});

currentPopupId = '';
var CustomOptionValidatorHolder = Class.create({
	initialize: function(validator_data) {
		this.groups = new Array();
		for(var group_name in validator_data) {
			if(validator_data.hasOwnProperty(group_name)) {
				group = new CustomOptionValidatorGroup(group_name);
				
				for(var validator_id in validator_data[group_name]) {
					if(validator_data[group_name].hasOwnProperty(validator_id)) {
						validator = new CustomOptionValidator(validator_id, validator_data[group_name][validator_id]);
						group.addValidator(validator);
					}
				}
				
				this.groups.push(group);
			}
		}
	},
	
	populateValidatorPopup: function(id_part) {
	    this.id_part = id_part;
	    that = this;
		currentPopupId = 'validators_'+id_part;
		
		//create groups & checkboxes
		validatorsDivContent = $(currentPopupId).down('.popup-content');
		validatorsDivContent.update('');
		inputType = $(id_part+'_type').options[$(id_part+'_type').selectedIndex].value;
		
		hasContent = false;
		for(i=0;i<this.groups.length;i++) {
			content = this.groups[i].getHtmlContent(inputType);
			if(content) {
				hasContent = true;
				validatorsDivContent.insert(this.groups[i].getHtmlHeader(inputType));
				validatorsDivContent.insert(content);
			}
		}
		if(hasContent) {
			//listen to onclick events & populate the hidden field
			
			accordion = new varienAccordion('validators_'+id_part, false);	
			
			//check selected values, populate extra fields & open accordions
			
			selectedOptions = $('custom_validators_'+id_part).value.split(' ');
			if(selectedOptions.length) {
				for(i1=0;i1<selectedOptions.length;i1++) {
					selectedOption = selectedOptions[i1];
					$$('#validators_'+id_part+' .validator-checkbox').each(function(el){
						if(el.value == selectedOption) {
							el.checked = true;
							validator = that.getValidatorForCheckboxId(el.id);
							if(validator.options.extra) {
								if(validator.options.extra.combined_prefix) {
									prefix = validator.options.extra.prefix;
									for(j1=0;j1<selectedOptions.length;j1++) {
										if(selectedOptions[j1].indexOf(prefix) == 0) {
											range = selectedOptions[j1].replace(prefix+'-','');
											range = range.split('-');
											currentPos = 0;
											$$('#'+currentPopupId+' .validator-'+validator.id+' .extra-field').each(function(element){
												element.value=range[currentPos];
												currentPos++;
											})
										}
									}
								}
								else {
									for(var element_id in validator.options.extra.elements) {
										if(validator.options.extra.elements.hasOwnProperty(element_id)) {
											for(j1=0;j1<selectedOptions.length;j1++) {
												if(selectedOptions[j1].indexOf(validator.options.extra.elements[element_id].prefix) != -1) {
													elementValue =  selectedOptions[j1].replace(validator.options.extra.elements[element_id].prefix+'-','');
													$$('#'+currentPopupId+' #'+validator.getExtraFieldId(element_id,validator.options.extra.elements[element_id]))[0].value = elementValue;
												}
											}
										}
									}
								} 
							}
							
							accordion.showItem(el.up().up().previous());
						}
					});
				}
			}
			
			
		}
		else {
			validatorsDivContent.insert(new Element('p',{'class':'no-validators'}).update('Validators are available only for text fields and text areas'));
		}
		
		
	},
	
	getValidatorForCheckboxId: function(checkbox_id) {
		for(i=0;i<this.groups.length;i++) {
			for(j=0;j<this.groups[i].validators.length;j++) {
				if(this.groups[i].validators[j].id == checkbox_id) {
					return this.groups[i].validators[j];
				}
			}
		}
	} ,
	
	validate: function() {
		that = this;
		hasErrors = false;
		$$('#'+currentPopupId+' .validator-checkbox').each(function(el){
			if(el.checked) {
				validatorObject = that.getValidatorForCheckboxId(el.id);
				if(validatorObject.options.extra) {
					for(var extra_id in validatorObject.options.extra.elements) {
						if(validatorObject.options.extra.elements.hasOwnProperty(extra_id)) {
							extraFieldId = validatorObject.getExtraFieldId(extra_id,validatorObject.options.extra.elements[extra_id]);
							extraFieldValue = parseInt($$('#'+currentPopupId+' #'+extraFieldId)[0].value);
							$(extraFieldId).removeClassName('error-required');
							if(validatorObject.options.extra.elements[extra_id].required && !extraFieldValue) {
								$(extraFieldId).addClassName('error-required');
								hasErrors = true;
							}
						}
					}
				}
			}
		})
		if(hasErrors) {
			alert("Please fill in all the required fields");
			return false;
		}
		else {
			return true;
		}
	},
	
	serializeCustomOptions: function() {
	   that = this;
	   selectedOptions = '';
	   $$('#'+currentPopupId+' .validator-checkbox').each(function(el){
	       if(el.checked) {
			    selectedOptions+=el.value+' ';
					
				//get extra values, if any
				validatorObject = that.getValidatorForCheckboxId(el.id);
				if(validatorObject.options.extra) {
					value = '';
					if(validatorObject.options.extra.combined_prefix) {
						value = validatorObject.options.extra.prefix;
					} 
					for(var extra_id in validatorObject.options.extra.elements) {
						if(validatorObject.options.extra.elements.hasOwnProperty(extra_id)) {
							extraFieldId = validatorObject.getExtraFieldId(extra_id,validatorObject.options.extra.elements[extra_id]);
							extraFieldValue = parseInt($$('#'+currentPopupId+' #'+extraFieldId)[0].value);
							if(validatorObject.options.extra.combined_prefix) {
								if(isNaN(extraFieldValue)) {
									extraFieldValue = 0;
								}
								value+='-'+extraFieldValue;
							}
							else {
								if(!isNaN(extraFieldValue)) {
									value = validatorObject.options.extra.elements[extra_id].prefix+'-'+extraFieldValue;
									selectedOptions+=value+' ';
								}
							}
						}
					}
					if(validatorObject.options.extra.combined_prefix) {
						selectedOptions+=value+' ';
					}
				}
			}
			$('custom_validators_'+that.id_part).value = selectedOptions;
		});
	}
});


function showHideConfigureValidatorsButtons() {
	$$('.select-product-option-type').each(function(el){
		selectedOption = el.options[el.selectedIndex].value;
		buttonId = el.id+'_cfg_button';
		if(selectedOption == 'field' || selectedOption == 'area') {
			$(buttonId).show();
		}
		else {
			$(buttonId).hide();
		}
	});	
}



