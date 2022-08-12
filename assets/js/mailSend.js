// Listen for a submit
document.querySelector(".contact_Form").addEventListener("submit", submitForm);

function submitForm(e) {
    e.preventDefault();

    let fname = document.querySelector(".fname").value;
    let lname = document.querySelector(".lname").value;
    //let position = document.querySelector(".position").value;
    let city = document.querySelector(".city").value;
    let email = document.querySelector(".email").value;
    let phoneNumber = document.querySelector(".phoneNumber").value;
    let neighberhood = document.querySelector(".neighberhood").value;
    let adres = document.querySelector(".adres").value;
    let phoneNumber_2 = document.querySelector(".phoneNumber_2".value);
    let lname_2 = document.querySelector(".lname_2").value;
    let tc_kimlik = document.querySelector(".tc_kimlik").value;
    let email_2 = document.querySelector(".email_2").value;





    //let fileType = document.querySelector(".file").value;
    //let photo = document.querySelector(".file").files[0];

    // var urlImageYolu;

    // let photo = document.getElementById("image-file");

    // let file = photo.files[0];
    // console.log("file:", file);

    // let fileReader = new FileReader();
    // fileReader.readAsDataURL(file);
    // console.log("File yolu:", fileReader);

    // fileReader.onload = () => {
    //     urlImageYolu = fileReader.result;




    // };



    // let formData = new FormData();

    // formData.append("image-file", photo);

    // console.log("image: " + formData)

    //   saveContactInfo(name, email, message);

    //   document.querySelector(".contact-form").reset();
    try {

        // fileReader.onload = () => {
        //     let urlImageYolu = fileReader.result;

        sendEmail(
            fname, lname, city,
            email,
            phoneNumber,
            neighberhood,
            adres,
            phoneNumber_2,
            lname_2,
            tc_kimlik,
            email_2

        );



        // };

    } catch (e) {
        localStorage.setItem('mailsended', 'false');
    }
}

function sendEmail(
    fname, lname, city, email, phoneNumber, neighberhood, adres, phoneNumber_2, lname_2, tc_kimlik, email_2
) {

    Email.send({
        Host: " smtp.elasticemail.com ",
        Username: "webcontactmessages@gmail.com",
        Password: "BCCB4307F4D39707257D488ACF8158E1F9A6",

        //Password: "BCCB4307F4D39707257D488ACF8158E1F9A6",
        // Host: "smtp.yandex.com.tr",
        // Username: "abdoul.kowi@hibritmedya.com.tr",
        // Password: "wxhcdfnykhydvvda",

        // smtp.yandex.com.tr
        // abdoul.kowi@hibritmedya.com.tr
        // wxhcdfnykhydvvda


        // // SecureToken : "3def6893-8292-4b1b-9594-1b5226b8d044",
        //To: "info@medheedconsultancy.com",
        // From: "info@medheedconsultancy.com",

        //Host: "smtp.gmail.com",
        //Username: "webcontactmessages@gmail.com",
        //Password: "BCCB4307F4D39707257D488ACF8158E1F9A6",
        // To: "abdoulkowiyy2020@gmail.com",
        // From: `${email}`,

        // Subject: `${name} size bir mesaj gönderdi`,
        // Body: `İsim: ${name} <br/>
        //  Email: ${email} <br/> 
        //  Telefon Numarası: ${telefon} <br/> 
        //  Mesaj: ${mesaj}`,



        //SecureToken: "8ecc1b04-84da-40b5-b6c7-ca259e5b8006",

        //SecureToken: "4cb0b652-39fa-4844-b6a9-a4df459cc7b3",



        //SecureToken: "db12f86e-86b9-4f34-8b2d-0a60a261db54",
        // path: `${fileType}`

        To: "abdoulkowiyy2020@gmail.com",
        From: `controlza2021@gmail.com`,
        Subject: `${fname} size bir mesaj gönderdi`,
        Body: `
           <h1> Adres Bilgilerini Giriniz</h1> <br/>
         İsim: ${fname + lname} <br/>
         Email: ${email} <br/>
         İletişim Telefon: ${phoneNumber}<br/>
         Telefon: ${phoneNumber_2} <br/>
         İl: ${city} <br/>
         İlçe: ${neighberhood} <br/>
         Adres : ${adres} <br/>  
          <h1> Fatura Bilgileri</h1> <br/>
          Ad Soyad : ${lname_2} <br/>
          Tc Kimlik No: ${tc_kimlik} <br/>
          E-Posta : ${email_2}`,




    }).then((message) => {
            localStorage.setItem('mailsended', 'true'),
                console.log("hee tamam oldu"),
                //console.log("gitti mail"),
                alert(message)
                // console.log(message)

        }

    ).catch((e) => {
        localStorage.setItem('mailsended', 'false'),
            console.log("hee olmadi")

    })
}