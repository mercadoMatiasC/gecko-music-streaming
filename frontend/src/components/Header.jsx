//ONLY FOR MOBILE
export function Header(){
    return (
        <header className="w-full xl:hidden">
            <nav className="bg-black/80 p-4">
                <ul className="w-full flex justify-between text-white">
                    <li>Profile</li>
                    <li>Browse</li>
                    <li>Player</li>
                    <li>Settings</li>
                </ul>
            </nav>
        </header>
    );
}