import redis
import pandas

def last_ten_connections(r):
    users = r.smembers("user")

    last_connections = []

    for user_id in users:

        last_connection = r.xrevrange(user_id, count = 1)[0]

        time_key = list(last_connection[1].keys())[2]

        time = last_connection[1][time_key]

        last_connections.append({"user" : user_id, "time" : time})

    top_10 = pandas.DataFrame(last_connections).sort_values('time', ascending=False).head(10)
    
    return top_10

if __name__ == "__main__":

    r = redis.Redis(host='localhost', port=6379, db=0)

    top_10 = last_ten_connections(r)

    print("Last ten connected users")
    print(top_10)

    
