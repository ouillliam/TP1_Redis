# TP1_Redis

## Architecture Redis

Les connexions de chaque utilisateur sont stockées dans un *Stream* de clé `user_id`.
Ainsi on se rapproche d'un système de logging.
Le Stream m'a paru la structure la plus adaptée car c'est une structure append-only.
Pour chaque utilisateur on a donc une structure qui ressemble à :
```
1) 1) 1518951480106-0 # id de la connexion générée par redis
   2) 1) 1            # user_id
      2) vente        # service
      3) 1518951480   # date connexion en seconde epoch
2) 1) 1518951485205-0
      ...
```
L'id de la connexion dans le stream est générée par Redis à partir de la date d'ajout de la connexion.

Pour trouver le nombre de connexions de l'utilisateur dans les dernières 10 minutes, il suffit alors de retirer 10 * 60 = 600 secondes au temps de la tentative de connexion, par exemple tentative de connexion à 1518951480 -> -600 -> 1518950880.

Puis on utilise la commande xrevrange(user_id, +, 1518950880) qui retourne toutes les connexions depuis le temps 1518950880 jusqu'à la dernière connexion du stream. Il ne reste plus qu'a regarder le nombre de connexions retournées.

Quand un utilisateur se connecte pour la première fois, on ajoute son `user_id` à un set de clé `"user"`, ainsi on pourra récupérer tous les `user_id` et parcourir tous les streams de connexion.

## Script python

Pour éxécuter le script : `python3 script.py user_id service`, retourne 1 si la connexion est validée, 0 sinon.
