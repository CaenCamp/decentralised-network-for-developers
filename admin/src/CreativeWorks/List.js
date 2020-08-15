import React from "react";
import { PropTypes } from 'prop-types';
import {
    Datagrid,
    EditButton,
    List,
    TextField,
    Filter,
    TextInput,
    ReferenceArrayField,
    ChipField,
    SingleFieldList,
} from 'react-admin';

const Logo = ({ record }) => {
    return record && record.image ? (
        <img src={record.image} height="50" alt={record.name} />
    ) : (
        `Pas de image pour "${record.name}"`
    );
};
Logo.propTypes = {
    record: PropTypes.shape({
        name: PropTypes.string.isRequired,
        image: PropTypes.string,
    }),
};

const CreativeWorkFilter = props => (
    <Filter {...props}>
        <TextInput source="name" label="Nom" alwaysOn />
    </Filter>
);

export const CreativeWorkList = (props) => (
    <List
        {...props}
        filters={<CreativeWorkFilter />}
        sort={{ field: 'name', order: 'ASC' }}
        bulkActionButtons={false}
        title="Liste des talks"
        perPage={25}
    >
        <Datagrid>
            <Logo label="Logo" />
            <TextField source="name" label="Titre" />
            <TextField source="disambiguatingDescription" label="Résumé" />
            <TextField source="learningResourceType" label="Type de talk" />
            <TextField source="encoding" label="Support" />
            <TextField source="video" label="Vidéo" />
            <ReferenceArrayField label="Mainteneurs" reference="people" source="maintainers">
                <SingleFieldList>
                    <ChipField source="name" />
                </SingleFieldList>
            </ReferenceArrayField>
            <EditButton />
        </Datagrid>
    </List>
);

