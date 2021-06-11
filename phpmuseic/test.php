


if isset(knapp)
    query = DELETE FROM playlitssong 
                WHERE songid = $songid
                AND playlistid = $playlistid