<?php

namespace Drupal\graphql_compose_extend\Plugin\GraphQL\SchemaExtension;

use Drupal\graphql_compose\Plugin\GraphQL\SchemaExtension\SdlSchemaExtensionPluginBase;
use Drupal\graphql\GraphQL\ResolverRegistryInterface;
use Drupal\graphql\GraphQL\ResolverBuilder;

/**
 * Extends the GraphQL schema with custom fields.
 *
 * @SchemaExtension(
 *   id = "graphql_compose_extend_graphql_schema_extension",
 *   name = "GraphQL Compose Extend GraphQL Schema Extension",
 *   schema = "graphql_compose"
 * )
 */
class GraphQLComposeExtendGraphQLSchemaExtension extends SdlSchemaExtensionPluginBase {

  public function registerResolvers(ResolverRegistryInterface $registry) {
    $builder = new ResolverBuilder();
    $this->addQueryFields($registry, $builder);
    $this->addGraphQLComposeExtendFields($registry, $builder);
  }

  /**
   * @param \Drupal\graphql\GraphQL\ResolverRegistryInterface $registry
   * @param \Drupal\graphql\GraphQL\ResolverBuilder $builder
   */
  protected function addQueryFields(ResolverRegistryInterface $registry, ResolverBuilder $builder) {
    $registry->addFieldResolver(
      'Query',
      'custom',
      $builder->callback(fn () => TRUE)
    );
  }

  /**
   * @param \Drupal\graphql\GraphQL\ResolverRegistryInterface $registry
   * @param \Drupal\graphql\GraphQL\ResolverBuilder $builder
   */
  protected function addGraphQLComposeExtendFields(ResolverRegistryInterface $registry, ResolverBuilder $builder) {
    $registry->addFieldResolver('Custom', 'currentDateAndTime',
      $builder->produce('current_date_and_time')
    );
  }

}
