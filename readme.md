#Raiffeisen (Shtepia Ime)

## API functions

### Login for web

- method(login)
- route(api/auth/login)

> Variable: 

* email
* password | sha1 (password) 

> Nese eshte e sakte kthen nje JSON: 
```json
{
    "response": "Success",
    "message": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjY4LCJpc3MiOiJodHRwOi8vc2h0ZXBpYWltZS5hbC9hcGkvYXV0aC9sb2dpbm4iLCJpYXQiOjE1MTI2Mzk4NDcsImV4cCI6MTUxMjY0MzQ0NywibmJmIjoxNTEyNjM5ODQ3LCJqdGkiOiJ1TWVTRnZGNjBXaUU3Mlp5In0.oY2TRx9ySpC56JIbYakO-m_EK3xv1vJYrP4bmek-Fus",
        "user": {
            "id_user": 68,
            "name": "admin",
            "username": "admin",
            "email": "admin@admin.com",
            "phone": "686868688",
            "role": "0",
            "created_at": null,
            "updated_at": null
        }
    }
}
```

> Nese nuk eshte e sakte:
```json
  {
    "response" : "Error",
    "error_code" : -1,
    "message" : "Username/Password wrong!"
  }
```

### Login for mobile

 - method (mobileLogin)
 - route (api/auth/loginn) 

> Variable: 

* phone
* password

> Nese eshte e sakte kthen nje JSON (shembull): 
```json
{
    "response": "Success",
    "message": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjY4LCJpc3MiOiJodHRwOi8vc2h0ZXBpYWltZS5hbC9hcGkvYXV0aC9sb2dpbm4iLCJpYXQiOjE1MTI2Mzk4NDcsImV4cCI6MTUxMjY0MzQ0NywibmJmIjoxNTEyNjM5ODQ3LCJqdGkiOiJ1TWVTRnZGNjBXaUU3Mlp5In0.oY2TRx9ySpC56JIbYakO-m_EK3xv1vJYrP4bmek-Fus",
        "user": {
            "id_user": 68,
            "name": "admin",
            "username": "admin",
            "email": "admin@admin.com",
            "phone": "686868688",
            "role": "0",
            "created_at": null,
            "updated_at": null
        }
    }
}
```

> Nese nuk eshte e sakte kthen nje JSON (shembull) :
```json
  {
      "response": "Error",
      "message": "Username/Password wrong"
  }
```
### Sign Up

- method(signup)
- route(api/auth/signup)

> Variable : 

*  email | info@raiffeisen.co
*  password | *******
*  name | info
*  username | info123
*  phone | 123456
*  role | (hidden: 0 = admin, 1 = client, 2 = agency)

> Nese eshte e sakte kthen nje JSON
```json
{
    "response": "Success",
    "message": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjY4LCJpc3MiOiJodHRwOi8vc2h0ZXBpYWltZS5hbC9hcGkvYXV0aC9sb2dpbm4iLCJpYXQiOjE1MTI2Mzk4NDcsImV4cCI6MTUxMjY0MzQ0NywibmJmIjoxNTEyNjM5ODQ3LCJqdGkiOiJ1TWVTRnZGNjBXaUU3Mlp5In0.oY2TRx9ySpC56JIbYakO-m_EK3xv1vJYrP4bmek-Fus",
        "user": {
            "id_user": 68,
            "name": "admin",
            "username": "admin",
            "email": "admin@admin.com",
            "phone": "686868688",
            "role": "0",
            "created_at": null,
            "updated_at": null
        }
    }
}
```

> Nese useri ekziston kthen: 
```json
  {
    "response" : "Error",
    "error_code" : -1,
    "message" : "User already exists!"
  }
```


### Make appointment

 - method(make_appointment)
 - route(api/public/appointment)

> Variable:  

* title | Mrs
* name | Zhaklina
* lastname | Basha
* phone | +35568686888
* liked | wed
* email | zhaklinabasha@hotmail.com
* preferences | dsjnjsef
* description | description
* postcode |  1001


> Nese eshte e sakte kthen nje JSON
```json
  {
    "response" : "Success",
    "message" : "Appointment Addedd!"
  }
```
> Nese nuk eshte e sakte kthen
```json
  {
    "response" : "Error",
    "error_code" : -1,
    "message" : "Could not add the appointment"
  }
```
### Retrieve all posts

 - method(showPost)
 - route(api/public/admin/blog/retrieve)

> Example response (on Success):
```json
 {
    "response": "Success",
    "posts": [
        {
            "id_post": 10,
            "title": "rfrfefsfe",
            "cover": "HEwOZQhJeIHqrOk5Rp94jAXcBac8bUMTdYw37XUM.jpeg",
            "description": "<p>refweweewdwede</p>",
            "id_category": "1",
            "created_at": "2017-12-22 15:40:46",
            "updated_at": "2017-12-22 15:40:46",
            "photo_path": "https://www.shtepiaime.al/storage/blog/"
        }
    ]
}
```

### Retrieve All offers

  - method (map)
  - route (api/public/map)

> Nese eshte e sakte kthen
```json  
    [
     {
        "id_offer": 830,
        "name": "Apartament 1+1 (73 m2)  Kodra e Diellit",
        "address": "Rruga Kodra e Diellit, TIrane",
        "latitude": 41.30926850395109,
        "longitude": 19.800807237625122,
        "photo": "y7eifc94hj448c88co.jpg"
      }     
    ]  
```

### Retrieve All offers

  - method (offers)
  - route (api/public/offers)

> Nese eshte e sakte kthen: 
```json  
    [
      {
        "id_offer": 830,
        "name": "Apartament 1+1 (73 m2)  Kodra e Diellit",
        "address": "Rruga Kodra e Diellit, TIrane",
        "latitude": 41.30926850395109,
        "longitude": 19.800807237625122,
        "photo": "y7eifc94hj448c88co.jpg"
      }
    ]
```

### search by address

  - method search_by_city_address
  - route (api/public/search)

> Variables: 

* address
* centerLat
* centerLng
* neLat
* neLng

> Nese eshte e sakte kthen  (with a circular radius we calculate)
```json  
    [
      {
          "id_offer": 830,
          "name": "Apartament 1+1 (73 m2)  Kodra e Diellit",
          "address": "Rruga Kodra e Diellit, TIrane",
          "latitude": 41.30926850395109,
          "longitude": 19.800807237625122,
          "photo": "y7eifc94hj448c88co.jpg"    
      },
    ]
```

### Advanced Search

- method advanced_search
- route (api/public/advancedSearch)

> Variable: 

* centerLat
* centerLng
* neLat
* neLng
* include
* parking_spaces
* bathroom
* priceRngMin
* priceRngMax
* bedroomsMin
* bedroomsMax
* property_type  | [0 -> Any, 1 -> House, 2-> Apartament/Unit, 3 -> New House & Land , 4 -> Land, 5 -> Rural]
* include | [ 0 -> do not include, 1 -> include ]
* newListing | [ 1 -> gets the offers that are created in 7 days.  ]
* sort | address (by default) than you can choose=>  lowest | highest | newest | oldest
* showMap |map (gets them all, in any other case gets 20 by pagination)

> Nese eshte e sakte kthen:
```json
  {
    "offer": {
        "current_page": 1,
        "data": [
            {
                "id_offer": 831,
                "name": "Apartment 1+1 (60 m2)  tek Hipoteka",
                "address": "Rruga Jordan Misja, Tirane",
                "description": "Apartamenti lokalizohet ne nje kompleks rezidencial nga me cilesoret dhe funksionalet ne zonen e Hipotekes, Harry Fultz, prane gjitha faciliteteve te mundshme. Organizohet ne sallon dhe kend gatimi, dhome gjumi, holl, tualet dhe ballkon. Ka nje siperfaqe te brendshme 60 m2, shperndarje interesante dhe orientim Lindje. Cmim poshte references se shtetit, i pershtashem per familje te re ose per investim-qira, pasi zona eshte e preferuar dhe nga te huajt. Nxitoni ta beni tuajin kete apartament, ju lutem na kontaktoni .",
                "euro": "62000",
                "leke": "8301800",
                "note": "Kesti i paraqitur, eshte perllogaritur per afatin maksimal sipas kushteve standarte te bankes per    kredine hipotekore. Per me shume informacion ju lutem kontaktoni agjentin e Bankes me te dhenat e meposhtme.",
                "active": "1",
                "type_id": "3",
                "user_id": "37",
                "bankAgent_id": "256",
                "created_at": "2017-06-06 19:20:34",
                "updated_at": null,
                "latitude": "41.336228488960735",
                "longitude": "19.812222719192505",
                "bedrooms": "1",
                "bathrooms": "0",
                "parking_space": "0",
                "size": "60",
                "air_conditioning": "0",
                "heating": "0",
                "secure_parking": "0",
                "solar_panel": "0",
                "water_tank": "0",
                "inspectionTime": "0000-00-00 00:00:00",
                "type": "Apartamente 1+1",
                "distance": "0.9425612520673204",
                "photos": [
                    {
                        "id_photo": 2,
                        "photo": "s594zvoec6s8cowog.jpg",
                        "offer_id": "831",
                        "created_at": "2017-06-06 19:20:34",
                        "updated_at": null,
                        "photo_path": "http://www.shtepiaime.al/api/storage/"
                    },
                    {
                        "id_photo": 257,
                        "photo": "94zbnn7i9x4ww0s0co.jpg",
                        "offer_id": "831",
                        "created_at": "2017-06-06 19:20:34",
                        "updated_at": null,
                        "photo_path": "http://www.shtepiaime.al/api/storage/"
                    },
                    {
                        "id_photo": 512,
                        "photo": "bm939a26dzk8o8444k.jpg",
                        "offer_id": "831",
                        "created_at": "2017-06-06 19:20:34",
                        "updated_at": null,
                        "photo_path": "http://www.shtepiaime.al/api/storage/"
                    },
                    {
                        "id_photo": 767,
                        "photo": "hmx35h3k5zww0k08.jpg",
                        "offer_id": "831",
                        "created_at": "2017-06-06 19:20:34",
                        "updated_at": null,
                        "photo_path": "http://www.shtepiaime.al/api/storage/"
                    }
                ]
            }
            
            ],
            "from": 1,
             "next_page_url": "http://www.shtepiaime.al/api/public/advancedSearch?page=2",
             "path": "http://www.shtepiaime.al/api/public/advancedSearch",
             "per_page": 20,
             "prev_page_url": null,
             "to": 20
            },
            "count": 114
```

> Nese nuk ka te dhena kthen :
```json
  {
      "current_page": 1,
      "data": [],
      "from": null,
      "next_page_url": null,
      "path": "http://127.0.0.1:8000/api/public/advancedSearch",
      "per_page": 20,
      "prev_page_url": null,
      "to": null
  }  
```


### Nearby places

  - method (nearby_places)
  - route (api/public/nearby/{offer_id}) | Shembull: offer_id = 831

> Nese eshte ne rregull kthen:
```json
  [
    {
        "id_offer": 839,
        "name": "Apartament 2+1(91.7m2) tek Rruga Fortuzi",
        "address": "Rruga Prokop Myzeqari, Rr. Fortuzi, Tirane",
        "description": "Apartamenti ka nje siperfaqe prej 91.7 m2, i organizuar ne nje ambient gatimi dhe ndenjie te vecante, dy dhoma gjumi, nje tualet, nje ballkon. Apartamenti ka nje orientim shume te mire jug -perendim, qe ben te mundur qe shtepia te kete shume drite.  Apartamenti ndodhet ne katin e gjashte te nje ndertimi te ri, ne nje nder rruget kryesore, me hyrje nga disa mini-rruge lidhese. Apartamenti shitet bosh. Eshte i pajisur me certifikate pronesie. Cmimi 1015 euro meter/katror. Total 93000 euro, i diskutueshem.",
        "euro": 93000,
        "leke": 12555000,
        "note": "Kesti i paraqitur, eshte perllogaritur per afatin maksimal sipas kushteve standarte te bankes per    kredine hipotekore. Per me shume informacion ju lutem kontaktoni agjentin e Bankes me te dhenat e meposhtme.",
        "active": 1,
        "type_id": 4,
        "user_id": 10,
        "bankAgent_id": 257,
        "created_at": "2017-06-09 16:59:25",
        "updated_at": null,
        "latitude": 41.33323384153238,
        "longitude": 19.81367690472416,
        "inspectionTime": "0000-00-00 00:00:00",
        "bedrooms": 2,
        "bathrooms": 0,
        "parking_space": 0,
        "size": 0,
        "air_conditioning": 0,
        "heating": 0,
        "secure_parking": 0,
        "solar_panel": 0,
        "water_tank": 0,
        "type": "Apartamente 2+1",
        "distance": 0.3544336847798216,
        "photos": [
            {
                "id_photo": 8,
                "photo": "1mt7336s2wpw0kckcw.jpg",
                "offer_id": "839",
                "created_at": "2017-06-09 16:59:25",
                "updated_at": null,
                "photo_path": "https://www.shtepiaime.al/api/storage/"
            },
            {
                "id_photo": 263,
                "photo": "2bz21ixm2nwg84g8og.jpg",
                "offer_id": "839",
                "created_at": "2017-06-09 16:59:25",
                "updated_at": null,
                "photo_path": "https://www.shtepiaime.al/api/storage/"
            },
            {
                "id_photo": 518,
                "photo": "23hxeptrvvdw84oooc.jpg",
                "offer_id": "839",
                "created_at": "2017-06-09 16:59:25",
                "updated_at": null,
                "photo_path": "https://www.shtepiaime.al/api/storage/"
            },
            {
                "id_photo": 773,
                "photo": "1pczmlb6myckwoc440.jpg",
                "offer_id": "839",
                "created_at": "2017-06-09 16:59:25",
                "updated_at": null,
                "photo_path": "https://www.shtepiaime.al/api/storage/"
            }
        ]
    },
]
```

### User_edit
  - method (edit)
  - route (api/myhome/user/edit)

> Variables: 

* email
* name
* password
* username
* phone

> Nëse eshte e sakte kthen
```json
  [
    {
      "response" : "Success",
      "message" : "User Updated!"
    }
  ]
```
### user_delete
  - method (delete)
  - route (api/myhome/user/delete)

> Nëse eshte e sakte kthen: 
```json
  [
    {
      "response" : "Success",
      "message" : "Account Deleted!"
    }
  ]
```

> Nëse nuk eshte e sakte kthen
```json
  [
    {
      "response" : "Success",
      "message" : "Account could not be deleted!"
    }
  ]
```
### interes get
- method (get)
- route (api/public/interes)

> Nese eshte e sakte kthen :
```json
{
    "1": {
        "id_interes": 2,
        "first_year": 4.5,
        "next_years": 5.5,
        "active": 1,
        "created_at": null,
        "updated_at": null
    }
}
```
### interes_create

- method (create)
- route (api/myhome/admin/create)

> Variable :

  * first_year | 2.5
  * next_years | 5.3

> Nese eshte e sakte kthen:
```json
  [
    {
      "response" : "Success",
      "message" : "Interest Added!"
    }
  ]
```

> Nese nuk eshte e sakte kthen (shembull)
```json
  [
    {
      "response" : "Error",
      "message" : "You can't add this interest!"
    }
  ]
```

> Nese nuk ke permission kthen (shembull)
```json
  [
    {
      "response" : "Error",
      "message" : "You don't have permission to access this!"
    }
  ]
```

### interes retrieve

- method (retrieve)
- route (api/myhome/admin/retrieve)

> Nese eshte e sakte kthen (shembull)
```json
  [ 
    {
      "id_interes": 1,
      "first_year": 4.5,
      "next_years": 5.5,
      "active": 1,
      "created_at": null,
      "updated_at": null
    }
  ]
```

> Nese nuk eshte e sakte kthen (shembull): 
```json
  [
    {
      "response" : "Error" ,
      "message" : "Can't read the data"
    }
  ]
```

> Nese nuk ke permission kthen (shembull)
```json
  [
    {
      "response" : "Error",
      "message" : "You don't have permission to access this!"
    }
  ]
```

### interes edit
- method (edit)
- route (api/myhome/admin/interes/{id_interes}/edit)

> Variables :

* first_year | 2.5
* next_years | 5.3

> Nese eshte e sakte kthen (shembull): 
```json
  [
    {
      "response" : "Success",
      "message" : "Interest updated!"
    }
  ]
```

> Nese nuk eshte e sakte kthen
```json
  [
    {
      "response" : "Error",
      "message" : "You can't update this interest!"
    }
  ]
```

> Nese nuk ke permission kthen
```json
  [
    {
      "response" : "Error",
      "message" : "You don't have permission to access this!"
    }
  ]
```
### interes delete
  - method (delete)
  - route (api/myhome/admin/interes/{id_interes}/delete)

> Nese eshte e sakte kthen (shembull):
```json
    [
      {
        "response" : "Success",
        "message" : "Interest deleted!"
      }
    ]
```

> Nese nuk eshte e sakte kthen
```json
    [
      {
        "response" : "Error",
        "message" : "You can't delete this interest!"
      }
    ]
```

> Nese nuk ke permission kthen
```json
    [
      {
        "response" : "Error",
        "message" : "You don't have permission to access this!"
      }
    ]
```
