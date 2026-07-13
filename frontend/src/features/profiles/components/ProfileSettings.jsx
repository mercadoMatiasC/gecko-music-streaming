import { Link } from "react-router-dom";

export function ProfileSettings(){
    const links = [
        {label: "Settings", route: "#"},
        {label: "Log out",  route: "/Login"},
    ]
    
    return (
        <ul id="settings-dropdown" className="flex gap-3 mx-3">
             {links.map((link) => (
                <Link to={link.route}>
                    <li key={link.id}>
                        {link.label}
                    </li>
                </Link>
            ))}
        </ul>
    );
}