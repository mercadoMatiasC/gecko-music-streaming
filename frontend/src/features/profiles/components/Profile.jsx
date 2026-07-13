import { useState } from "react";
import { ProfileSettings } from "./ProfileSettings";

export function Profile(){
    const [profileDropdown, setProfileDropdown] = useState(false);

    const user = {
        id: 1,
        username: "mattTheWolf",
        followers: 24,
        following: 14,
    };

    return (
        <section id="user-profile" className="w-full flex flex-col h-screen xl:w-1/4">
            <span className="flex flex-row-reverse px-6 py-3">
                <img src="svgs/three-dots.svg" width={24} alt="Options" onClick={() => setProfileDropdown(!profileDropdown)} className="hover:cursor-pointer" />
                {profileDropdown && <ProfileSettings />}
            </span>

            <main className="h-full flex flex-col justify-between p-8">
                <span className="flex flex-col gap-3">
                    <div className="flex items-center justify-between">
                        <img src="#" alt="User Avatar" className="bg-neutral-700 w-24 h-24 rounded-full drop-shadow-md drop-shadow-black"/>
                        <h1 className="text-2xl font-bold">{user.username}</h1>
                    </div>

                    <div className="flex items-center justify-between text-xl">
                        <h2>Followers: {user.followers}</h2>
                        <h2>Following: {user.following}</h2>
                    </div>

                    <div className="flex flex-col gap-3 mt-5">
                        <a href="#">My playlists</a>
                        <a href="#">Liked playlists</a>
                    </div>
                </span>

                <div className="flex justify-end">
                    <img src="/images/text-logo.png" alt="Gecko Text Logo" width={128} className="w-[128px]"/>
                </div>
            </main>
        </section>
    );
}