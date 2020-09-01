import React from "react";
import { PropTypes } from 'prop-types';
import {
    DateField,
    Datagrid,
    EditButton,
    List,
    TextField,
    Filter,
    TextInput,
    ChipField,
    ReferenceArrayField,
    SingleFieldList,
    ReferenceField,
} from 'react-admin';

const Logo = ({ record }) => {
    return record && record.logo ? (
        <img src={record.image} height="50" alt={record.name} />
    ) : (
        `Pas d'image pour "${record.name}"`
    );
};
Logo.propTypes = {
    record: PropTypes.shape({
        name: PropTypes.string.isRequired,
        image: PropTypes.string,
    }),
};

const EventFilter = props => (
    <Filter {...props}>
        <TextInput source="name" label="Nom" alwaysOn />
    </Filter>
);

export const EventList = (props) => (
    <List
        {...props}
        filters={<EventFilter />}
        sort={{ field: 'name', order: 'ASC' }}
        bulkActionButtons={false}
        title="Liste des évènements"
        perPage={25}
    >
        <Datagrid>
            <Logo label="Logo" />
            <TextField source="name" label="Titre" />
            <DateField source="startDate" label="Date" showTime/>
            <ReferenceField label="Organisateur" source="organizer" reference="organizations">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceField label="Sponsor" source="sponsor" reference="organizations">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceArrayField label="Talks" reference="creative_works" source="worksPerformed">
                <SingleFieldList>
                    <ChipField source="name" />
                </SingleFieldList>
            </ReferenceArrayField>
            <EditButton />
        </Datagrid>
    </List>
);

