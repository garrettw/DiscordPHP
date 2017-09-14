REST endpoint: https://discordapp.com/api/v#

# When updating deps
- Pawl and Buzz both req react/socket-client. Currently they are set at 0.5
    and they must stay together.

# To connect
1. Request WS endpoint via REST API
2. Connect to result via Pawl using query string ?v=6&encoding=json
3. Parse response payload - should be 10 HELLO
4. Begin sending 1 HEARTBEAT at specified interval
5. Begin detecting zombied/failed connections by listening for 11 HEARTBEAT_ACK
    - If no 11 ACK received between 1 HB attempts:
        - term conn with non-1000 close code
        - reconnect
        - attempt resume
6. Send 2 IDENTIFY -or- 6 RESUME (expect either Ready or Resumed response)
    - IDENTIFY no more than once every 5 sec, and 1000 every 24h (would be every 12s).
    - if RESUME fails, will receive 9 INVALID_SESSION. Wait random time 1-5s, then send 2 ID.
7. Client is connected

# Rate limits
- 120 events every 60 seconds
- one gateway connection per 5 seconds
- update their game status 5 times per minute

# Taken from composer.json

    "cache/array-adapter": "^1.0",
    "illuminate/support": "^5.4",
    "nesbot/carbon": "^1.22",
    "react/datagram": "^1.2",
    "react/partial": "^2.0",
    "TrafficCophp/ByteBuffer": "^0.3"
