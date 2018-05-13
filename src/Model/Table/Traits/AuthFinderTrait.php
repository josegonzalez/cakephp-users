<?php
namespace Users\Model\Table\Traits;

trait AuthFinderTrait
{
    /**
     * Find user based on auth config
     *
     * @param \Cake\ORM\Query $query The query to find with
     * @param array $options The options to find with
     * @return \Cake\ORM\Query The query builder
     */
    public function findAuth($query, $options)
    {
        $query = $this->find();
        if (!empty($options['active'])) {
            $query->where(['active' => true]);
        }
        if (!empty($options['emailAuthenticated'])) {
            $query->where(['email_authenticated' => true]);
        }

        return $query;
    }
}
