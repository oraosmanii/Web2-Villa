class Bookingu {
    constructor(emri, mbiemri, email, adresa, city, state, bank, numberOfNights) {
        this.emri = emri;
        this.mbiemri = mbiemri;
        this.email = email;
        this.adresa = adresa;
        this.city = city;
        this.state = state;
        this.bank = bank;
        this.numberOfNights = numberOfNights;
      }
  
 
      toString() {

        var data = new Date();

     console.log(data.toString());


        return `Name: ${this.emri}\nMbiemri: ${this.mbiemri}\nEmail: ${this.email}\nAddress: ${this.adresa}\nCity: ${this.city}\nState: ${this.state}\nBank: ${this.bank}\nNumber of Nights: ${this.numberOfNights.toString()}\nTime of Rent: ${data.toString()}`;
      }

}
let objekti;

function pasKlikimit() {
    var emri = document.getElementById('Emri').value;
    var mbiemri = document.getElementById('Mbiemri').value;
    var email = document.getElementById('exampleInputEmail1').value;
    var adresa = document.getElementById('inputAddress').value;
    var city = document.getElementById('inputCity').value;
    var bank = document.getElementById('bank').value;
    var state = document.getElementById('inputState').value;
    var numberOfnights = document.getElementById('a').value;

  
    console.log('Emri:', emri);
    console.log('Mbiemri:', mbiemri);
    console.log('Email:', email);
    console.log('Address:', adresa);
    console.log('City:', city);
    console.log('Bank:', bank);
    console.log('State:', state);
    console.log('Number of Nights:', numberOfnights);

    objekti = new Bookingu(emri, mbiemri, email, adresa, city, state, bank, numberOfnights);

    return objekti;  
}

document.addEventListener('DOMContentLoaded', function () {
    var buttonBooking = document.getElementById('buttoni');

    buttonBooking.onclick = function () {
        var objekti = pasKlikimit();  
//validimi
        if (objekti.state.trim() === '' || objekti.email.trim() === '' || objekti.city.trim() === '' || objekti.adresa.trim() === '' || objekti.mbiemri.trim() === '' || objekti.emri.trim() === '') {
            alert('Please fill in all required fields.');
            return;
        }

   
        pasKlikimit();
        var stringu = objekti.toString();
        alert('You have successfully rented! Here are your details:\n' + stringu);

        setTimeout(function () {
            window.location.reload();
        }, 100);
        console.log("button clicked");
    };
});

  
  