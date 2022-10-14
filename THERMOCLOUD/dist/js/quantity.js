/**
 *  @class
 *  @function Quantity
 *  @param {DOMobject} element to create a quantity wrapper around
 */
var indicequantity=1;
export default class QuantityInput {
  constructor(self, decreaseText, increaseText) {
    // Create input
    this.input = document.createElement('input');
    this.input.value = 1;
    this.input.type = 'number';
    this.input.name = 'quantity';
    this.input.pattern = '[0-9]+';
    var inputTempSelector = "quantity"  + indicequantity.toString();
    indicequantity++;
    this.input.setAttribute("id", inputTempSelector);
    // Get text for buttons
    this.decreaseText = decreaseText || 'Decrease quantity';
    this.increaseText = increaseText || 'Increase quantity';

    // Button constructor
    function Button(text, className){
      this.button = document.createElement('button');
      this.button.type = 'button';
      this.button.innerHTML = text;
      this.button.title = text;
      this.button.classList.add(className);

      return this.button;
    }

    // Create buttons
    this.subtract = new Button(this.decreaseText, 'sub');
    this.add = new Button(this.increaseText, 'add');

    // Add functionality to buttons
    this.subtract.addEventListener('click', () => this.change_quantity(-1));
    this.add.addEventListener('click', () => this.change_quantity(1));

    // Add input and buttons to wrapper
    self.appendChild(this.subtract);
    self.appendChild(this.input);
    self.appendChild(this.add);
  }

  change_quantity(change) {
    // Get current value
    let quantity = Number(this.input.value);
    var _id= this.input.getAttribute('id');
    // Ensure quantity is a valid number
    if (isNaN(quantity)) quantity = 1;

    // Change quantity
    quantity += change;

    // Ensure quantity is always a number
    quantity = Math.max(quantity, 1);

    // Output number
    this.input.value = quantity;
    if (deviceList.responseText == undefined) {
      var datos = deviceList;
    } else {
      var datos = JSON.parse(deviceList.responseText);
    }
    
    //alert("antes de modificar " + datos[deviceListNumber].TempLimitMenor);
    if (_id == "quantity1") datos[deviceListNumber].TempLimitMenor= quantity.toString();
    if (_id == "quantity2") datos[deviceListNumber].TempLimitMayor= quantity.toString();
    if (_id == "quantity3") datos[deviceListNumber].HRLimitMenor= quantity.toString();
    if (_id == "quantity4") datos[deviceListNumber].HRLimitMayor= quantity.toString();
    deviceList=datos;
    //alert("luego de modificar " + deviceList[deviceListNumber].TempLimitMenor);    
  }
}
