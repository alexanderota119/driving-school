export const ucFirst = (string: string = ''): string => {
    return string[0].toUpperCase() + string.slice(1);
};

export const toTitleCase = (str: string, singular: boolean = true): string => {
    let rtv = str.replace(/_/g, ' ');

    if (singular) {
        rtv = rtv.replace(/s$/, '');
    }

    return rtv.replace(/\w\S*/g, function (txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
};

export const slug = (str: string): string =>
    str
        .toLowerCase()
        .replace(/\s+/g, '-')
        .replace(/[^\u0100-\uFFFF\w\-]/g, '-')
        .replace(/\-\-+/g, '-')
        .replace(/^-+/, '')
        .replace(/-+$/, '');
