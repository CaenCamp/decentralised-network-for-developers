import React from "react";
import {
    Datagrid,
    EditButton,
    List,
    TextField,
    Filter,
    TextInput,
    ChipField,
    ReferenceArrayField,
    SingleFieldList,
} from 'react-admin';

import { Logo } from '../Organizations/List';

const PeopleFilter = props => (
    <Filter {...props}>
        <TextInput source="familyName" label="Nom" alwaysOn />
    </Filter>
);

export const PeopleList = (props) => (
    <List
        {...props}
        filters={<PeopleFilter />}
        sort={{ field: 'familyName', order: 'ASC' }}
        bulkActionButtons={false}
        title="Liste des personnes participant aux CaenCamp.s"
        perPage={25}
    >
        <Datagrid>
            <Logo label="Logo" />
            <TextField source="familyName" label="Nom" />
            <TextField source="givenName" label="Prénom" />
            <TextField source="disambiguatingDescription" label="Résumé" />
            <TextField source="url" label="Site" />
            <ReferenceArrayField label="Membre de" reference="organizations" source="memberOf">
                <SingleFieldList>
                    <ChipField source="name" />
                </SingleFieldList>
            </ReferenceArrayField>
            <EditButton />
        </Datagrid>
    </List>
);

