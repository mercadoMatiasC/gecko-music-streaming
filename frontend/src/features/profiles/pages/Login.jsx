import { Link } from "react-router-dom";
import { DefaultButton } from "../../../components/DefaultButton";

export function Login(){
    return (
        <section id="login" className="w-full h-screen flex items-center justify-center bg-amber-400">
            <div className="w-[60%] h-[50%] rounded-4xl bg-black/65 flex flex-col justify-center items-center px-8 space-y-6">
                <div className="w-full flex justify-between items-center">
                    <img src="/images/text-logo.png" alt="Gecko Text Logo" height={4} className="h-16" />
                    <img src="svgs/player-record.svg" alt="Record" width={128} className="w-32 animate-spin" />
                </div>

                <form action="#" method="POST" className="w-full flex flex-col space-y-2">
                    <label htmlFor="username">Username</label>
                    <input type="text" name="username" required />

                    <label htmlFor="password" className="mt-8">Password</label>
                    <input type="password" name="password" required />

                    <div className="flex justify-between mt-4">
                        <Link to="#" className="underline">Forgot your password</Link>
                        <DefaultButton label="Log in" onClick={() => (1+1)} />
                    </div>
                </form>
            </div>
        </section>
    );
}