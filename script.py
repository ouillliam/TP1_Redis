import redis
import sys
import time

# EXEC : script.py user_id service

def append_connection(user_id, r, service):
    data = {
        "user_id" : user_id, 
        "service" : service,
        "time" :  r.time()[0]
        }

    # append this connection to the stream
    r.xadd(user_id, data)

def check_connection_valid(user_id, r):

    # get number of connections of user
    len_connexion_stream = r.xlen(user_id)
    
    # if user has never logged in yet or less than 10 times
    if not len_connexion_stream or len_connexion_stream < 10: 

        # Add user in set of all users for future stats
        r.sadd("user", user_id)

        return True

    # epoch time ten minutes ago
    ten_minutes_ago = ( r.time()[0] - ( 60 * 10 ) ) * 1000

    # Get the last connections of user in the ten last minutes
    last_connections = r.xrevrange(user_id, max = "+", min = ten_minutes_ago)
    
    # Check if user has logged in less than 10 times in the last ten minutes
    if len(last_connections) < 10 :
        return True

    return False



if __name__ == "__main__":

    r = redis.Redis(host='localhost', port=6379, db=0)

    connection_authorized = 0

    # Get user_id from sys args 
    user_id = sys.argv[1] if len(sys.argv) > 1 else 51

    service = sys.argv[2] if len(sys.argv) > 2 else "non précisé"

    is_valid_connection = check_connection_valid(user_id, r)

    if is_valid_connection:

        append_connection(user_id, r, service)

        connection_authorized = 1

    # Return 1 to shell if connection has been authorized else 0
    print(connection_authorized)
    sys.exit(0)



