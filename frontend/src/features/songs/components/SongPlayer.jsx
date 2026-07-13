import { useState } from "react";
import { DefaultButton } from "../../../components/DefaultButton";

export function SongPlayer(){
    const [isPlaying, setIsPlaying] = useState(false);

    const song = {
        id: 1,
        uploader: "mattTheWolf",
        album: "Dear Agony",
        artist: "Breaking Benjamin",
        title: "Lights Out",
        play_count: 7189919,
    };

    const next_song = {
        id: 2,
        uploader: "marioBros",
        album: "Stitch These Wounds",
        artist: "Black Veil Brides",
        title: "Perfect Weapon",
        play_count: 28350221,
    };

    return (
        <section id="song-player" className="w-full flex flex-col h-screen xl:w-1/4">
            {/* NEXT SONG DETAILS */}
            <span className="flex flex-col">
                <div className="flex h-8 bg-black/85 p-4 items-center text-sm">
                    Coming next...
                </div>

                <div className="group flex h-18 bg-neutral-900/80 p-4 gap-3 items-center justify-between hover:cursor-pointer">
                    <span className="flex gap-3 items-center">
                        <div width="128" className="bg-white p-6"></div>
                        <div className="flex flex-col">
                            <p className="text-sm">{next_song.artist} - {next_song.album}</p>
                            <p className="text-md">{next_song.title}</p>
                        </div>
                    </span>
                    
                    <img src="svgs/rchevron.svg" width={32} alt="Next" onClick={() => (1+1)} className="group-hover:translate-x-2 ease-in-out transition-all duration-300" />
                </div>
            </span>

            <main className="h-full flex flex-col justify-between p-8">
                {/* CURRENT SONG DETAILS */}
                <span className="flex flex-col">
                    <h2 className="text-xl">{song.artist} - {song.album}</h2>
                    <h1 className="text-2xl font-bold">{song.title}</h1>
                </span>

                {/* SPINNING RECORD */}
                <div className="flex justify-center items-center h-120">
                    <img src="svgs/player-record.svg" alt="Record" className={`h-[75%] ${isPlaying && "animate-spin"}`} />
                </div>

                {/* PLAYER */}
                <div className="w-full flex justify-between">
                    <button><img src="svgs/player-shuffle.svg" width={32} alt="Shuffle" onClick={() => (1+1)} /></button>

                    <span className="flex justify-between gap-8">
                        <button><img src="svgs/player-previous.svg" width={48} alt="Previous Song" onClick={() => (1+1)} /></button>

                        {isPlaying ? (
                            <button onClick={() => setIsPlaying(false)}>
                                <img src="svgs/player-pause.svg" width={64} alt="Pause" />
                            </button>
                        ):(
                            <button onClick={() => setIsPlaying(true)}>
                                <img src="svgs/player-play.svg" width={64} alt="Play" />
                            </button>
                        )}

                        <button><img src="svgs/player-forward.svg" width={48} alt="Next Song" onClick={() => (1+1)} /></button>
                    </span>

                    <button><img src="svgs/player-repeat.svg" width={32} alt="Repeat" onClick={() => (1+1)} /></button>
                </div>

                <div className="flex justify-between ">
                    <DefaultButton label="Save to playlist" />
                    <button className="hidden xl:flex">
                        <img src="svgs/player-fullscreen.svg" width={32} alt="Fullscreen" onClick={() => (1+1)} />
                    </button>
                </div>
            </main>
        </section>
    );
}