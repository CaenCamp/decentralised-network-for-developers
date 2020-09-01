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
    ReferenceManyField,
    ChipField,
    SingleFieldList,
    ReferenceField,
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
            <ReferenceField label="Type de support" source="learningResourceType" reference="learning_resource_types">
                <TextField source="name" />
            </ReferenceField>
            <ReferenceManyField label="Les supports" reference="creative_work_materials" source="originId" target="encodesCreativeWork">
                <SingleFieldList>
                    <ChipField source="abstract" />
                </SingleFieldList>
            </ReferenceManyField>
            <ReferenceManyField label="Les vidéos" reference="video_objects" source="originId" target="encodesCreativeWork">
                <SingleFieldList>
                    <ChipField source="abstract" />
                </SingleFieldList>
            </ReferenceManyField>
            <ReferenceArrayField label="Membres" reference="people" source="maintainers">
                <SingleFieldList>
                    <ChipField source="name" />
                </SingleFieldList>
            </ReferenceArrayField>
            <EditButton />
        </Datagrid>
    </List>
);

