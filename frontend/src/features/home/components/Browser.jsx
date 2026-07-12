export function Browser(){
    const playlist_tile_class = "bg-purple-900 p-5 rounded-md hover:bg-purple-900/80 hover:cursor-pointer ease-in-out transition-all duration-300 drop-shadow-xl drop-shadow-black";
    const user_tile_class = "flex p-5 justify-between items-center drop-shadow-md drop-shadow-black";

    return (
        <div className="w-full flex flex-col h-screen xl:w-1/2 py-5 justify-center items-center px-8 bg-white/5">
            {/* CONTENT BROWSING */}
            <section id="content-browser" className="w-full space-y-3">
                <form action="#" className="flex flex-col justify-center gap-3">
                    <label htmlFor="song-query">Search for your favourite songs or artists</label>
                    <input type="search" placeholder="Search..." />
                </form>

                <span className="flex flex-col">
                    <p className="flex justify-between">
                        <h1>Recent saved playlists</h1>
                        <a href="#">See all</a>
                    </p>
                    <div className="grid grid-cols-2 gap-5 py-5">
                        <div className={playlist_tile_class}>Saved Playlist 1</div>
                        <div className={playlist_tile_class}>Saved Playlist 2</div>
                        <div className={playlist_tile_class}>Saved Playlist 3</div>
                        <div className={playlist_tile_class}>Saved Playlist 4</div>
                        <div className={playlist_tile_class}>Saved Playlist 5</div>
                        <div className={playlist_tile_class}>Saved Playlist 6</div>
                    </div>

                </span>
            </section>

            {/* USERS BROWSING */}
            <section id="user-browser" className="w-full space-y-3">
                <form action="#" className="flex flex-col justify-center gap-3">
                    <label htmlFor="song-query">Search for your users</label>
                    <input type="search" placeholder="Search..." />
                </form>

                <span className="flex flex-col">
                    <p className="flex justify-between">
                        <h1>Recent followers</h1>
                        <a href="#">See all</a>
                    </p>
                    <div className="grid grid-cols-2 py-3">
                        <div className={user_tile_class}>
                            <span className="flex gap-3 items-center">
                                <img src="#" alt="x" className="bg-purple-900 w-16 h-16"/>
                                user_name_1
                            </span>
                           
                            <a href="#">See profile</a>
                        </div>
                        <div className={user_tile_class}>
                            <span className="flex gap-3 items-center">
                                <img src="#" alt="x" className="bg-purple-900 w-16 h-16"/>
                                user_name_1
                            </span>
                           
                            <a href="#">See profile</a>
                        </div>
                        <div className={user_tile_class}>
                            <span className="flex gap-3 items-center">
                                <img src="#" alt="x" className="bg-purple-900 w-16 h-16"/>
                                user_name_1
                            </span>
                           
                            <a href="#">See profile</a>
                        </div>
                        <div className={user_tile_class}>
                            <span className="flex gap-3 items-center">
                                <img src="#" alt="x" className="bg-purple-900 w-16 h-16"/>
                                user_name_1
                            </span>
                           
                            <a href="#">See profile</a>
                        </div>
                        <div className={user_tile_class}>
                            <span className="flex gap-3 items-center">
                                <img src="#" alt="x" className="bg-purple-900 w-16 h-16"/>
                                user_name_1
                            </span>
                           
                            <a href="#">See profile</a>
                        </div>
                        <div className={user_tile_class}>
                            <span className="flex gap-3 items-center">
                                <img src="#" alt="x" className="bg-purple-900 w-16 h-16"/>
                                user_name_1
                            </span>
                           
                            <a href="#">See profile</a>
                        </div>
                    </div>

                </span>
            </section>
        </div>
        
    );
}