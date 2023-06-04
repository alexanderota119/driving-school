export interface NavProps {
    label: string;
    link: string;
    separator?: boolean;
    icon?: string;
    color?: string;
    children?: NavProps[];
}
