import { Profile } from "../../profiles/components/Profile";
import { SongPlayer } from "../../songs/components/SongPlayer";
import { Browser } from "../components/Browser";

export function Index(){
    return (
        <main className="w-full flex justify-between">
            <Profile />
            <Browser />
            <SongPlayer />
        </main>
    );
}