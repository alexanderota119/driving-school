export const settings = (key: string, value: any = undefined) => {
    if (value === undefined) {
        const found = localStorage.getItem(key);

        try {
            const storedValue = found ? JSON.parse(found || '{}') : found;

            if (storedValue === 'true') {
                return true;
            }
            if (storedValue === 'false') {
                return false;
            }

            return storedValue as any;
        } catch (e) {
            return found;
        }
    }

    return localStorage.setItem(key, JSON.stringify(value));
};
