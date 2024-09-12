
export interface minisidebar {
    icon?: string;
    id?:number;
    tooltip?:string
}
const MiniSideIcons: minisidebar[] = [
    {
        icon: 'layers-line-duotone',
        tooltip:'Dashboards',
        id: 1
    },
    {
        icon: 'notes-line-duotone',
        tooltip:'Pages',
        id: 2,
    },
    {
        icon: 'palette-round-line-duotone',
        tooltip:'Forms',
        id: 3
    },
    {
        icon:'align-vertical-spacing-broken',
        tooltip:'Tables',
        id: 4
    },
    {
        icon:'chart-line-duotone',
        tooltip:'Charts',
        id: 5
    },
    {
        icon:'widget-6-line-duotone',
        tooltip:'UI Components',
        id: 6
    },
    {
        icon:'lock-keyhole-line-duotone',
        tooltip:'Authentication Pages',
        id: 7
    },
    {
        icon:'mirror-left-line-duotone',
        tooltip:'Others',
        id: 8
    }
]

export default MiniSideIcons;
