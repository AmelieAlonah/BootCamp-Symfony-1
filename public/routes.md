# Routes possibles

| URL          | Méthode HTTP | Controller       | Méthode | Titre                        | Commentaire               |
| ------------ | ------------ | ---------------- | ------- | ---------------------------- | ------------------------- |
| `/`          | `GET`        | `BirdController` | `home`  | A Field Guide to Angry Birds | Liste des oiseaux         |
| `/bird/{id}` | `GET`        | `BirdController` | `show`  | {birdName} - Angrybirds      | Détail d'un oiseau        |
| `/api/birds` | `GET`        | `ApiController`  | `birds` | -                            | JSON du tableau d'oiseaux |
