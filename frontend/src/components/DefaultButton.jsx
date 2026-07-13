export function DefaultButton({ onClick, label = "PLACEHOLDER" }){
    const style = "p-3 border-1 border-white/80 bg-black/60 rounded-2xl";

    return (
        <button onClick={() => onClick} className={`${style}`}>
            {label}
        </button>
    );
}